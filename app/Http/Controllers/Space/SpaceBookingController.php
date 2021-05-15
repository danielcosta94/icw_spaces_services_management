<?php

namespace App\Http\Controllers;

use App\Mail\SpaceUserBooking;
use App\Mail\SpaceUserBookingCancel;
use App\Models\Country;
use App\Models\Space;
use App\Models\SpaceBooking;
use App\Models\SpaceBookingAvailability;
use App\Models\SpaceBookingDetail;
use App\Models\SpacePricePlan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Error\ApiConnection;
use Stripe\Error\Authentication;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Stripe\Error\RateLimit;
use Stripe\Refund;
use Stripe\Stripe;

class SpaceBookingController extends Controller
{
    const MIN_HOUR_LIMIT_CHECK_IN = 2;
    const MIN_DAYS_LIMIT_CANCEL = 7;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allBookingsMySpaces()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userType = $user->user_type->user_type;

        if($userType != 'admin') {
            $all_bookings_my_spaces = SpaceBooking::getAllBookingsMySpaces($id)->paginate(10);
        } else {
            $all_bookings_my_spaces = SpaceBooking::paginate(10);
        }

        return view('space_manager.space_bookings.all_bookings_my_spaces', compact('all_bookings_my_spaces'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $space_bookings = SpaceBooking::getAllMyBookings($user->id)->paginate(10);
        return view('space_manager.space_bookings.index', compact('space_bookings'));
    }

    private function getCurrencyCode($space)
    {
        $geocode = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $space->latitude . "," . $space->longitude . "&key=" . env('GOOGLE_MAPS_API_KEY'));
        $output = json_decode($geocode);

        $number_of_results = count($output->results);
        $number_address_components_result = count($output->results[$number_of_results - 1]->address_components);
        $country_code = $output->results[$number_of_results - 1]->address_components[$number_address_components_result - 1]->short_name;

        $country = Country::findOrFail($country_code);

        return $country != null ? $country->currency : null;
    }

    private function getSpaceAvailabilityByDate($date_format, $space)
    {
        switch($date_format->dayOfWeek) {
            case Carbon::MONDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'monday')->first();
                break;
            }
            case Carbon::TUESDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'tuesday')->first();
                break;
            }
            case Carbon::WEDNESDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'wednesday')->first();
                break;
            }
            case Carbon::THURSDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'thursday')->first();
                break;
            }
            case Carbon::FRIDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'friday')->first();
                break;
            }
            case Carbon::SATURDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'saturday')->first();
                break;
            }
            case Carbon::SUNDAY: {
                $space_availabilty = $space->space_availabilties()->where('day_week', 'sunday')->first();
                break;
            }
        }
        return $space_availabilty;
    }

    private function isSlotReserved($date_temp, $date_temp_end, $space) {
        $isReserved = false;

        while ($date_temp->lte($date_temp_end) && !$isReserved) {
            $space_availabilty = $this->getSpaceAvailabilityByDate($date_temp, $space);

            if ($space_availabilty != null) {
                $space_booking_details_date = SpaceBookingDetail::getSpaceBookingDetailsByDate($space->id, $date_temp->toDateString());
                if(count($space_booking_details_date) == 0) {
                    $date_temp->addDay();
                } else {
                    $isReserved = true;
                }
            } else {
                $date_temp->addDay();
            }
        }
        return $isReserved;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'date' => 'required|date',
            'space_id' => 'required|integer|min:1',
            'space_price_plan' => 'required|integer|min:1',
            'duration' => 'required|integer|between:1,20',
            'stripeEmail' => 'required|email|max:120',
            'stripeToken' => 'required|string',
        ];

        $space_booking_info = Input::all();
        $validation = Validator::make($space_booking_info, $rules);

        if ($validation->passes()) {
            $space_booking = null;
            try {
                Stripe::setApiKey(config('services.stripe.secret'));

                $user_id = Auth::user()->id;
                $user = User::findOrFail($user_id);

                $space = Space::findOrFail($request->space_id);

                if($space->validated == true) {
                    if($space->active == true) {
                        $date = explode("-", $request->date);
                        $date_format = Carbon::createFromDate($date[0], $date[1], $date[2]);

                        if ($date_format->gte(Carbon::now())) {
                            $currency = $this->getCurrencyCode($space);
                            if ($currency != null) {
                                $space_price_plan_id = Input::get('space_price_plan');
                                $space_price_plan = SpacePricePlan::where([['id',  $space_price_plan_id], ['active', true]])->first();

                                if($space_price_plan != null) {
                                    $space_booking = SpaceBooking::create([
                                        'user_id_client' => $user_id,
                                        'space_id' => $space->id,
                                        'space_price_plan' => $space_price_plan->payment_plan_type->plan,
                                        'payment_stripe_id' => "NULL",
                                        'status_booking' => 'Reserved',
                                        'price_unit' => $space_price_plan->price,
                                        'duration' => $request->duration,
                                        'start_datetime' => $request->date,
                                        'end_datetime' => $request->date,
                                        'currency' => $currency->name,
                                    ]);

                                    $start_hour = null;
                                    $end_hour = null;
                                    switch ($space_price_plan->payment_plan_type->plan) {
                                        case 'hour': {
                                            $start_hour = Input::get('start_hour');
                                            $end_hour = Input::get('end_hour');

                                            if ($start_hour < $end_hour) {
                                                $space_booking->duration = $end_hour - $start_hour;
                                                $space_booking->save();

                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_format, $space);

                                                if ($space_availabilty == null) {
                                                    $space_booking->forceDelete();
                                                    return response()->json(['status' => "Space Is Not Available In " . $date_format->toDateString() . "!!!"], 400);
                                                } else {
                                                    $space_booking_details_date = SpaceBookingDetail::getSpaceBookingDetailsByDateHour($space->id, $date_format->toDateString(),
                                                        $start_hour, $end_hour);

                                                    if (count($space_booking_details_date) > 0) {
                                                        $space_booking->forceDelete();
                                                        return response()->json(['status' => "Space Is Not Available Between " . $start_hour . "H and " . $end_hour . "H!!!"], 400);
                                                    }
                                                    $space_booking->start_datetime = Carbon::create($date_format->year, $date_format->month,
                                                        $date_format->day, $start_hour);
                                                    $space_booking->end_datetime = Carbon::create($date_format->year, $date_format->month,
                                                        $date_format->day, $end_hour);

                                                    $space_booking->save();

                                                    for ($hour = $start_hour; $hour < $end_hour; $hour++) {
                                                        SpaceBookingDetail::create([
                                                            'space_booking_id' => $space_booking->id,
                                                            'hour' => $hour,
                                                            'date' => $date_format,
                                                        ]);
                                                    }
                                                }
                                            } else {
                                                $space_booking->forceDelete();
                                                return response()->json(['status' => "Start Hour Equals or Superior to End Hour!!!"], 400);
                                            }
                                            break;
                                        }
                                        case 'day': {
                                            $duration = $request->duration;

                                            $date_temp = Carbon::createFromFormat('Y-m-d', $date_format->toDateString());
                                            $date_temp_format = Carbon::createFromFormat('Y-m-d', $date_format->toDateString());

                                            do {
                                                $date_temp_end = $date_temp_format->addDay();
                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_temp_format, $space);

                                                if ($space_availabilty != null) {
                                                    $duration--;
                                                }
                                            } while ($duration > 0);

                                            $isReserved = $this->isSlotReserved($date_temp, $date_temp_end, $space);

                                            if(!$isReserved) {
                                                for ($day = 0; $day < $request->duration; $day++) {
                                                    do {
                                                        $space_availabilty = $this->getSpaceAvailabilityByDate($date_format, $space);

                                                        if ($space_availabilty == null) {
                                                            $date_format->addDay();
                                                        }
                                                    } while ($space_availabilty == null);

                                                    for ($hour = $space_availabilty->opening_hour; $hour < $space_availabilty->closing_hour; $hour++) {
                                                        SpaceBookingDetail::create([
                                                            'space_booking_id' => $space_booking->id,
                                                            'hour' => $hour,
                                                            'date' => $date_format,
                                                        ]);
                                                    }
                                                    $date_format->addDay();
                                                }

                                                $space_availabilties = $space->space_availabilties()->get();

                                                foreach ($space_availabilties as $space_availabilty) {
                                                    SpaceBookingAvailability::create([
                                                        'space_reservation_id' => $space_booking->id,
                                                        'day_week' => $space_availabilty->day_week,
                                                        'opening_hour' => $space_availabilty->opening_hour,
                                                        'closing_hour' => $space_availabilty->closing_hour,
                                                    ]);
                                                }

                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_temp_end, $space);
                                                $space_booking->end_datetime = Carbon::create($date_temp_end->year, $date_temp_end->month,
                                                    $date_temp_end->day, $space_availabilty->closing_hour);
                                                $space_booking->save();

                                            } else {
                                                $space_booking->forceDelete();
                                                return response()->json(['status' => "This Period is already Reserved!!!"], 400);
                                            }
                                            break;
                                        }
                                        case 'week': {
                                            $duration = $request->duration;

                                            $date_temp_end = Carbon::createFromFormat('Y-m-d', $date_format->toDateString());
                                            $date_temp_end->addWeek($duration);
                                            $date_temp = Carbon::createFromFormat('Y-m-d', $date_format->toDateString());

                                            $isReserved = $this->isSlotReserved($date_temp, $date_temp_end, $space);

                                            if(!$isReserved) {
                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_format, $space);
                                                $space_booking->start_datetime = Carbon::create($date_format->year, $date_format->month,
                                                    $date_format->day, $space_availabilty->opening_hour);

                                                while ($date_format->lte($date_temp_end)) {
                                                    $space_availabilty = $this->getSpaceAvailabilityByDate($date_format, $space);

                                                    if ($space_availabilty != null) {
                                                        for ($hour = $space_availabilty->opening_hour; $hour < $space_availabilty->closing_hour; $hour++) {
                                                            SpaceBookingDetail::create([
                                                                'space_booking_id' => $space_booking->id,
                                                                'hour' => $hour,
                                                                'date' => $date_format,
                                                            ]);
                                                        }
                                                    }
                                                    $date_format->addDay();
                                                }

                                                $space_availabilties = $space->space_availabilties()->get();
                                                foreach ($space_availabilties as $space_availabilty) {
                                                    SpaceBookingAvailability::create([
                                                        'space_reservation_id' => $space_booking->id,
                                                        'day_week' => $space_availabilty->day_week,
                                                        'opening_hour' => $space_availabilty->opening_hour,
                                                        'closing_hour' => $space_availabilty->closing_hour,
                                                    ]);
                                                }

                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_temp_end, $space);
                                                $space_booking->end_datetime = Carbon::create($date_temp_end->year, $date_temp_end->month,
                                                    $date_temp_end->day, $space_availabilty->closing_hour);
                                                $space_booking->save();
                                            } else {
                                                $space_booking->forceDelete();
                                                return response()->json(['status' => "This Period is already Reserved!!!"], 400);
                                            }
                                            break;
                                        }
                                        case 'month': {
                                            $duration = $request->duration;

                                            $date_temp_end = Carbon::createFromFormat('Y-m-d', $date_format->toDateString());
                                            $date_temp_end->addMonth($duration);
                                            $date_temp = Carbon::createFromFormat('Y-m-d', $date_format->toDateString());

                                            $isReserved = $this->isSlotReserved($date_temp, $date_temp_end, $space);

                                            if(!$isReserved) {
                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_format, $space);
                                                $space_booking->start_datetime = Carbon::create($date_format->year, $date_format->month,
                                                    $date_format->day, $space_availabilty->opening_hour);


                                                while ($date_format->lte($date_temp_end)) {
                                                    $space_availabilty = $this->getSpaceAvailabilityByDate($date_format, $space);

                                                    if ($space_availabilty != null) {
                                                        for ($hour = $space_availabilty->opening_hour; $hour < $space_availabilty->closing_hour; $hour++) {
                                                            SpaceBookingDetail::create([
                                                                'space_booking_id' => $space_booking->id,
                                                                'hour' => $hour,
                                                                'date' => $date_format,
                                                            ]);
                                                        }
                                                    }
                                                    $date_format->addDay();
                                                }

                                                $space_availabilties = $space->space_availabilties()->get();

                                                foreach ($space_availabilties as $space_availabilty) {
                                                    SpaceBookingAvailability::create([
                                                        'space_reservation_id' => $space_booking->id,
                                                        'day_week' => $space_availabilty->day_week,
                                                        'opening_hour' => $space_availabilty->opening_hour,
                                                        'closing_hour' => $space_availabilty->closing_hour,
                                                    ]);
                                                }
                                                $space_availabilty = $this->getSpaceAvailabilityByDate($date_temp_end, $space);
                                                $space_booking->end_datetime = Carbon::create($date_temp_end->year, $date_temp_end->month,
                                                    $date_temp_end->day, $space_availabilty->closing_hour);
                                                $space_booking->save();
                                            } else {
                                                $space_booking->forceDelete();
                                                return response()->json(['status' => "This Period is already Reserved!!!"], 400);
                                            }
                                            break;
                                        }
                                        default: {
                                            $space_booking->forceDelete();
                                            $message = 'Invalid Price Plan!!';
                                            return response()->json(['status' => $message], 422);
                                            break;
                                        }
                                    }

                                    if ($user->stripe_id != null) {
                                        if ($space_price_plan->payment_plan_type->plan != 'hour') {
                                            try {
                                                $charge = Charge::create([
                                                    'customer' => $user->stripe_id,
                                                    'amount' => $space_price_plan->price * 100 * $request->duration,
                                                    'currency' => $currency->code
                                                ]);
                                            } catch (InvalidRequest $invalidRequest) {
                                                $customer = Customer::create([
                                                    'email' => $request->stripeEmail,
                                                    'source' => $request->stripeToken,
                                                ]);

                                                $user->stripe_id = $customer->id;
                                                $user->stripe_active = true;
                                                $user->save();

                                                $charge = Charge::create([
                                                    'customer' => $user->stripe_id,
                                                    'amount' => $space_price_plan->price * 100 * $request->duration,
                                                    'currency' => $currency->code
                                                ]);
                                            }
                                        } else {
                                            try {
                                                $charge = Charge::create([
                                                    'customer' => $user->stripe_id,
                                                    'amount' => ($end_hour - $start_hour) * 100 * $space_price_plan->price,
                                                    'currency' => $currency->code
                                                ]);
                                            } catch (InvalidRequest $invalidRequest) {
                                                $customer = Customer::create([
                                                    'email' => $request->stripeEmail,
                                                    'source' => $request->stripeToken,
                                                ]);

                                                $user->stripe_id = $customer->id;
                                                $user->stripe_active = true;
                                                $user->save();

                                                $charge = Charge::create([
                                                    'customer' => $user->stripe_id,
                                                    'amount' => ($end_hour - $start_hour) * 100 * $space_price_plan->price,
                                                    'currency' => $currency->code
                                                ]);
                                            }
                                        }
                                    } else {
                                        $customer = Customer::create([
                                            'email' => $request->stripeEmail,
                                            'source' => $request->stripeToken,
                                        ]);

                                        $user->stripe_id = $customer->id;
                                        $user->stripe_active = true;
                                        $user->save();
                                        if ($space_price_plan->payment_plan_type->plan != 'hour') {

                                            $charge = Charge::create([
                                                'customer' => $customer->id,
                                                'amount' => $space_price_plan->price * 100 * $request->duration,
                                                'currency' => $currency->code
                                            ]);
                                        } else {
                                            $charge = Charge::create([
                                                'customer' => $user->stripe_id,
                                                'amount' => ($end_hour - $start_hour) * 100 * $space_price_plan->price,
                                                'currency' => $currency->code
                                            ]);
                                        }
                                    }

                                    $space_booking->payment_stripe_id = $charge->id;
                                    $space_booking->save();

                                    try {
                                        Mail::to($space_booking->user->email)->send(new SpaceUserBooking($space_booking));
                                        Mail::to($space_booking->space->user->email)->send(new SpaceUserBooking($space_booking));
                                    } catch (\Exception $exception) {

                                    }
                                } else {
                                    $message = 'Invalid Price Plan!!';
                                    return response()->json(['status' => $message], 400);
                                }
                            } else {
                                $message = 'Currency doesn\'t exist!!!';
                                return response()->json(['status' => $message], 422);
                            }
                        } else {
                            $message = 'Impossible to make books on the past!!!';
                            return response()->json(['status' => $message], 400);
                        }
                    } else {
                        $message = 'Space Is Disabled!!!';
                        return response()->json(['status' => $message], 422);
                    }
                } else {
                    $message = 'Space Is Invalid!!!';
                    return response()->json(['status' => $message], 422);
                }
            } catch (Card $card) {
                $space_booking->forceDelete();
                return response()->json(['status' => $card->getMessage()], $card->getHttpStatus());
            } catch (RateLimit $rateLimit) {
                $space_booking->forceDelete();
                return response()->json(['status' => $rateLimit->getMessage()], $rateLimit->getHttpStatus());
            } catch (InvalidRequest $invalidRequest) {
                $space_booking->forceDelete();
                return response()->json(['status' => $invalidRequest->getMessage()], $invalidRequest->getHttpStatus());
            } catch (Authentication $authentication) {
                $space_booking->forceDelete();
                return response()->json(['status' => $authentication->getMessage()], $authentication->getHttpStatus());
            } catch (ApiConnection $apiConnection) {
                $space_booking->forceDelete();
                return response()->json(['status' => $apiConnection->getMessage()], $apiConnection->getHttpStatus());
            } catch (\Exception $exception) {
                $space_booking->forceDelete();
                $message = 'It appears that something went wrong with your payment. Please contact me before re-trying.';
                return response()->json(['status' => $message], 422);
            }
        } else {
            return response()->json(['status' => "Please Provide Valid Inputs!!!"], 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $space_booking = SpaceBooking::find($id);

        $id = Auth::user()->id;
        $user = User::find($id);
        $userType = $user->user_type->user_type;

        if (!is_null($space_booking)) {
            if($userType == 'admin') {
                return view('space_manager.space_bookings.show', compact('space_booking'));
            } else if (($userType == 'worker' ||  $userType == 'space_manager') &&
                ($space_booking->user_id_client == $id || $space_booking->space->user_id == $id)) {
                return view('space_manager.space_bookings.show', compact('space_booking'));
            } else {
                return Redirect::route('space_bookings.index')
                    ->with('message-error', trans('management.access_not_allowed'));
            }
        } else {
            return Redirect::route('space_bookings.index')
                ->with('message-error', trans('management_spaces.space_booking_not_found_msg'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $space_booking = SpaceBooking::find($id);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $userType = $user->user_type->user_type;

        if (!is_null($space_booking)) {
            $status_booking = Input::get('status_booking');

            if ($userType == 'admin' || (($userType == 'worker' ||  $userType == 'space_manager') &&
                    ($space_booking->user_id_client == $user_id || $space_booking->space->user_id == $user_id))) {
                if($space_booking->status_booking == 'Reserved') {

                    if ($status_booking == 'Check-In') {
                        $start_datetime_format = Carbon::createFromFormat('Y-m-d H:i:s', $space_booking->start_datetime);
                        $actual_datetime = Carbon::now();
                        if($start_datetime_format->diffInHours($actual_datetime) > self::MIN_HOUR_LIMIT_CHECK_IN) {
                            $space_booking->status_booking = 'Check-In';
                            $space_booking->save();

                            return Redirect::route('space_bookings.index')
                                ->with('message', trans('management_spaces.space_booking_check_in_msg'));
                        } else {
                            $start_datetime_format->subHour(self::MIN_HOUR_LIMIT_CHECK_IN);
                            return Redirect::route('space_bookings.index')
                                ->with('message-error', trans('management_spaces.space_booking_check_in_error_msg', ['date' => $start_datetime_format->toDateTimeString()]));
                        }
                    } elseif ($status_booking == 'Cancelled') {
                        $start_datetime_format = Carbon::createFromFormat('Y-m-d H:i:s', $space_booking->start_datetime);

                        $actual_datetime = Carbon::now();
                        if($start_datetime_format->diffInDays($actual_datetime) > self::MIN_DAYS_LIMIT_CANCEL) {

                            $space_booking->date_cancellation = $actual_datetime;

                            Stripe::setApiKey(config('services.stripe.secret'));

                            try {
                                Refund::create(array(
                                    "charge" => $space_booking->payment_stripe_id,
                                ));
                            } catch (InvalidRequest $invalidRequest) {
                                return Redirect::route('space_bookings.index')
                                    ->with('message-error', trans('management_spaces.space_booking_cancelled_refund_msg'));
                            } finally {
                                $space_booking->status_booking = 'Cancelled';

                                $space_booking->save();

                                $space_booking_details = SpaceBookingDetail::getAllBookingDetails($space_booking->id);
                                $space_booking_details->forceDelete();
                            }

                            try {
                                Mail::to($space_booking->user->email)->send(new SpaceUserBookingCancel($space_booking));
                                Mail::to($space_booking->space->user->email)->send(new SpaceUserBookingCancel($space_booking));
                            } catch (\Exception $exception) {
                            }
                            return Redirect::route('space_bookings.index')
                                ->with('message', trans('management_spaces.space_booking_cancelled_msg'));
                        } else {
                            $start_datetime_format->subDay(self::MIN_DAYS_LIMIT_CANCEL);
                            return Redirect::route('space_bookings.index')
                                ->with('message-error', trans('management_spaces.space_booking_cancelled_error_msg', ['date' => $start_datetime_format->toDateTimeString()]));
                        }
                    } else {
                        return Redirect::route('space_bookings.index')
                            ->with('message-error', trans('management.access_not_allowed'));
                    }
                } elseif ($space_booking->status_booking == 'Check-In') {
                    if ($status_booking == 'Check-Out') {
                        $end_datetime_format = Carbon::createFromFormat('Y-m-d H:i:s', $space_booking->end_datetime);

                        $actual_datetime = Carbon::now();
                        if($end_datetime_format->lte($actual_datetime)) {

                            $space_booking->status_booking = 'Check-Out';
                            $space_booking->save();

                            return Redirect::route('space_bookings.index')
                                ->with('message', trans('management_spaces.space_booking_check_out_msg'));
                        } else {
                            return Redirect::route('space_bookings.index')
                                ->with('message-error', trans('management_spaces.space_booking_check_out_error_msg', ['date' => $end_datetime_format->toDateTimeString()]));
                        }
                    } else {
                        return Redirect::route('space_bookings.index')
                            ->with('message-error', trans('management.access_not_allowed'));
                    }
                }
            } else {
                return Redirect::route('space_bookings.index')
                    ->with('message-error', trans('management.access_not_allowed'));
            }
        } else {
            return Redirect::route('space_bookings.index')
                ->with('message-error', trans('management_spaces.space_booking_not_found_msg'));
        }
    }
}
