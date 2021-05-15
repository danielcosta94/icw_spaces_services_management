<?php

namespace App\Http\Controllers;

use App\Mail\RequestSpaceInformation;
use App\Models\BusinessVertical;
use App\Models\PaymentPlanType;
use App\Models\Space;
use App\Models\SpaceExtrasGeneric;
use App\Models\SpacePhoto;
use App\Models\SpaceType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SpaceController extends Controller
{
    public function setValidation()
    {
        $space_id = Input::get('space_id');
        $validated = Input::get('validated');

        $space = Space::find($space_id);

        $id = Auth::user()->id;
        $user = User::find($id);
        $userType = $user->user_type->user_type;

        if (!is_null($space)) {
            if($userType == 'admin') {
                Space::set_space_validation($space_id, $validated);
            } else {
                return Redirect::route('spaces.index')
                    ->with('message-error', trans('management.access_not_allowed'));
            }
        } else {
            return Redirect::route('spaces.index')
                ->with('message-error', trans('management_spaces.space_not_found_msg'));
        }
    }

    public function setActivation()
    {
        $space_id = Input::get('space_id');
        $active = Input::get('active');

        $space = Space::findOrFail($space_id);

        $id = Auth::user()->id;
        $user = User::find($id);
        $userType = $user->user_type->user_type;

        if (!is_null($space)) {
            if($userType == 'admin' || ($userType == 'space_manager' && $space->user_id == $id)) {
                Space::set_space_activation($space_id, $active);
            } else {
                return Redirect::route('spaces.index')
                    ->with('message-error', trans('management.access_not_allowed'));
            }
        } else {
            return Redirect::route('spaces.index')
                ->with('message-error', trans('management_spaces.space_not_found_msg'));
        }
    }

    public function sendEmail(Request $request, $id)
    {
        $rules = [
            'description' => 'required|string',
        ];

        $currency_info = Input::all();
        $validation = Validator::make($currency_info, $rules);

        $space = Space::findOrFail($id);

        if ($validation->passes()) {
            $description = Input::get('description');

            $user_id = Auth::user()->id;
            $user = User::find($user_id);


            Mail::to($user)->send(new RequestSpaceInformation($user, $description, $space));

            return redirect()->route('space-details', ['id' => $space->id])->with('message_request', trans('management.message_sent'));
        } else {
            return redirect()->route('space-details', ['id' => $space->id])->with('message_request_error', trans('management.message_error'))->withErrors($validation);
        }
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
        $userType = $user->user_type->user_type;

        if($userType == 'admin') {
            $spaces = Space::paginate(10);
        } elseif ($userType == 'space_manager') {
            $spaces = Space::getAllUserSpaces($id)->paginate(10);
        }
        $spaces_photos = SpacePhoto::where('photo_type', '=', 'main');
        return view('space_manager.spaces.index', compact('spaces', 'spaces_photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_plan_types = PaymentPlanType::orderBy('id')->get();
        $space_types = SpaceType::orderBy('space_type')->get();;
        $business_verticals = BusinessVertical::orderBy('name')->get();;
        $space_generic_extras = SpaceExtrasGeneric::orderBy('name')->get();;
        return view('space_manager.spaces.create', compact('payment_plan_types', 'space_types', 'business_verticals', 'space_generic_extras'));
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
            'space_type_id' => 'required|integer',
            'name' => 'required|string|max:60',
            'business_vertical_id' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1|max:65535',
            'description' => 'required|string|max:500',
            'email' => 'required|email|max:120',
            'telephone_number' => 'required|string|max:60',
            'website' => 'nullable|string|max:70',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
        ];
        $space_info = Input::all();
        $validation_space = Validator::make($space_info, $rules);

        if ($validation_space->passes()) {

            $validation_photos = Validator::make($space_info, SpacePhotoController::rules($request));
            if ($validation_photos->passes()) {

                $validation_space_availabilty = Validator::make($space_info, SpaceAvailabilityController::rules($request));
                if ($validation_space_availabilty->passes()) {

                    $validation_price_plans = Validator::make($space_info, SpacePricePlanController::rules());
                    if ($validation_price_plans->passes()) {

                        $validation_space_extras = Validator::make($space_info, SpaceExtraController::rules());
                        if ($validation_space_extras->passes()) {
                            $space = new Space;

                            $space->user_id = Auth::user()->id;

                            $user = User::find($space->user_id);
                            $userType = $user->user_type->user_type;

                            if($userType == 'admin') {
                                $space->validated = true;
                            }

                            $space->name = $request->name;
                            $space->space_type_id = $request->space_type_id;
                            $space->business_vertical_id = $request->business_vertical_id;
                            $space->capacity = $request->capacity;
                            $space->description = $request->description;
                            $space->email = $request->email;
                            $space->telephone_number = $request->telephone_number;
                            $space->website = $request->website;
                            $space->latitude = $request->latitude;
                            $space->longitude = $request->longitude;

                            $space->save();

                            $space_photo_controller = new SpacePhotoController();
                            $space_photo_controller->store($request, $space->id);

                            $space_availability_controller = new SpaceAvailabilityController();
                            $space_availability_controller->store($request, $space->id);

                            $space_price_plan_controller = new SpacePricePlanController();
                            $space_price_plan_controller->store($request, $space->id);

                            $space_extra_controller = new SpaceExtraController();
                            $space_extra_controller->store($request, $space->id);

                            return Redirect::route('spaces.index')
                                ->with('message', trans('management_spaces.space_added_msg'));
                        } else {
                            return Redirect::route('spaces.create')
                                ->withInput()
                                ->withErrors($validation_space_extras);
                        }
                    } else {
                        return Redirect::route('spaces.create')
                            ->withInput()
                            ->withErrors($validation_price_plans);
                    }
                } else {
                    return Redirect::route('spaces.create')
                        ->withInput()
                        ->withErrors($validation_space_availabilty);
                }
            } else {
                return Redirect::route('spaces.create')
                    ->withInput()
                    ->withErrors($validation_photos);
            }
        } else {
            return Redirect::route('spaces.create')
                ->withInput()
                ->withErrors($validation_space);
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
        $space = Space::find($id);

        $id = Auth::user()->id;
        $user = User::find($id);
        $userType = $user->user_type->user_type;

        if (!is_null($space)) {
            if($userType == 'admin') {
                return view('space_manager.spaces.show', compact('space'));
            } else if ($userType == 'space_manager' && $space->user_id == $id) {
                return view('space_manager.spaces.show', compact('space'));
            } else {
                return Redirect::route('spaces.index')
                    ->with('message-error', trans('management.access_not_allowed'));
            }
        } else {
            return Redirect::route('spaces.index')
                ->with('message-error', trans('management_spaces.space_not_found_msg'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $space = Space::find($id);

        if (!is_null($space)) {
            $space_types = SpaceType::all();
            $business_verticals = BusinessVertical::all();
            $space_generic_extras = SpaceExtrasGeneric::all();
            $payment_plan_types = PaymentPlanType::all();
            $space_price_plans_details = Space::getSpacePricePlansDetails($id);

            return view('space_manager.spaces.edit', compact('space', 'space_types', 'business_verticals', 'space_generic_extras', 'payment_plan_types', 'space_price_plans_details'));
        } else {
            return Redirect::route('spaces.index')
                ->with('message-error', trans('management.space_not_found_msg'));
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
        $space = Space::find($id);

        if (!is_null($space)) {

            $space->user_id = Auth::user()->id;

            $user = User::find($space->user_id);
            $userType = $user->user_type->user_type;

            if($userType == 'admin' || ($userType == 'space_manager' && $space->user_id == $id)) {
                $rules = [
                    'space_type_id' => 'required|integer',
                    'name' => 'required|string|max:60',
                    'business_vertical_id' => 'required|integer|min:1',
                    'capacity' => 'required|integer|min:1|max:65535',
                    'description' => 'required|string|max:500',
                    'email' => 'required|email|max:120',
                    'telephone_number' => 'required|string|max:60',
                    'website' => 'nullable|string|max:70',
                    'latitude' => 'required|between:-90,90',
                    'longitude' => 'required|between:-180,180',
                ];
                $space_info = Input::all();
                $validation_space = Validator::make($space_info, $rules);

                if ($validation_space->passes()) {

                    $validation_space_availabilty = Validator::make($space_info, SpaceAvailabilityController::rules($request));
                    if ($validation_space_availabilty->passes()) {

                        $validation_price_plans = Validator::make($space_info, SpacePricePlanController::rules());
                        if ($validation_price_plans->passes()) {

                            $validation_space_extras = Validator::make($space_info, SpaceExtraController::rules());
                            if ($validation_space_extras->passes()) {

                                $space->name = $request->name;
                                $space->space_type_id = $request->space_type_id;
                                $space->business_vertical_id = $request->business_vertical_id;
                                $space->capacity = $request->capacity;
                                $space->description = $request->description;
                                $space->email = $request->email;
                                $space->telephone_number = $request->telephone_number;
                                $space->website = $request->website;
                                $space->latitude = $request->latitude;
                                $space->longitude = $request->longitude;

                                $space->update();

                                $space_availability_controller = new SpaceAvailabilityController();
                                $space_availability_controller->update($request, $space->id);

                                $space_price_plan_controller = new SpacePricePlanController();
                                $space_price_plan_controller->update($request, $space->id);

                                $space_extra_controller = new SpaceExtraController();
                                $space_extra_controller->update($request, $space->id);

                                return Redirect::route('spaces.index')
                                    ->with('message', trans('management_spaces.space_updated_msg'));
                            } else {
                                return Redirect::route('currencies.edit', $space)
                                    ->withInput()
                                    ->withErrors($validation_space_extras);
                            }
                        } else {
                            return Redirect::route('currencies.edit', $space)
                                ->withInput()
                                ->withErrors($validation_price_plans);
                        }
                    } else {
                        return Redirect::route('currencies.edit', $space)
                            ->withInput()
                            ->withErrors($validation_space_availabilty);
                    }
                } else {
                    return Redirect::route('currencies.edit', $space)
                        ->withInput()
                        ->withErrors($validation_space);
                }
            } else {
                return Redirect::route('spaces.index')
                    ->with('message-error', trans('management.access_not_allowed'));
            }
        } else {
            return Redirect::route('spaces.index')
                ->with('message-error', trans('management.space_not_found_msg'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $space = Space::find($id);

        $id = Auth::user()->id;
        $user = User::find($id);
        $userType = $user->user_type->user_type;

        if (!is_null($space)) {
            try {
                if($userType == 'admin') {
                    $space->forceDelete();
                    return Redirect::route('spaces.index')
                        ->with('message', trans('management_spaces.space_deleted_msg'));
                } else if ($userType == 'space_manager' && $space->user_id == $id) {
                    $space->forceDelete();
                    return Redirect::route('spaces.index')
                        ->with('message', trans('management_spaces.space_deleted_msg'));
                } else {
                    return Redirect::route('spaces.index')
                        ->with('message-error', trans('management.access_not_allowed'));
                }
            } catch (\PDOException $queryException) {
                return Redirect::route('spaces.index')
                    ->with('message-error', trans('management_spaces.space_usage_msg'));
            }
        } else {
            return Redirect::route('spaces.index')
                ->with('message-error', trans('management_spaces.space_not_found_msg'));
        }
    }
}
