<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Country;
use App\Models\Service;
use App\Models\Space;
use App\Models\SpaceBooking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');
    $this->get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail')->name('confirmEmail');

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/management_board', 'HomeController@index')->name('management_board');

    Route::get('/', function () {
        return view('index');
    })->name('home_page');

    Route::get('search_space', function () {
        return view('public.search_space');
    })->name('search_space');

    Route::get('search_service', function () {
        return view('public.search_service');
    })->name('search_service');

    Route::get('space-details/{id}', function ($id) {
        $space = Space::find($id);

        if(!is_null($space)) {
            if($space->validated) {
                $geocode = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $space->latitude . "," . $space->longitude . "&key=" . env('GOOGLE_MAPS_API_KEY'));
                $output = json_decode($geocode);

                $number_of_results = count($output->results);
                $number_address_components_result = count($output->results[$number_of_results - 1]->address_components);
                $country_code = $output->results[$number_of_results - 1]->address_components[$number_address_components_result - 1]->short_name;

                $country = Country::find($country_code);

                if($country != null) {
                    $currency = $country->currency;

                    $user = Auth::user();
                    if($user != null) {
                        $user_id = Auth::user()->id;
                        $user = User::find($user_id);

                        return view('public.space-details', compact('user', 'currency', 'space'));
                    } else {
                        return view('public.space-details', compact('currency', 'space'));
                    }
                } else {
                    $currency = null;

                    $user = Auth::user();
                    if($user != null) {
                        $user_id = Auth::user()->id;
                        $user = User::find($user_id);

                        return view('public.space-details', compact('currency', 'user', 'space', 'space_reviews'));
                    } else {
                        return view('public.space-details', compact('currency', 'space', 'space_reviews'));
                    }
                }
            } else {
                return view('errors.401');
            }
        } else {
            return view('errors.404');
        }
    })->name('space-details');




    Route::get('about', function () {
        return view('public.about');
    })->name('about');

    Route::get('blog-full-width', function () {
        return view('public.blog-full-width');
    })->name('blog-full-width');

    Route::get('blog-left-sidebar', function () {
        return view('public.blog-left-sidebar');
    })->name('blog-left-sidebar');

    Route::get('blog-right-sidebar', function () {
        return view('public.blog-right-sidebar');
    })->name('blog-right-sidebar');

    Route::get('contact', function () {
        return view('public.contact');
    })->name('contact');

    Route::get('gallery', function () {
        return view('public.gallery');
    })->name('gallery');

    Route::get('sample-page', function () {
        return view('public.sample-page');
    })->name('sample-page');

    Route::get('single-property', function () {
        return view('public.single-property');
    })->name('single-property');

    Route::get('spaces_visible', function (Request $request) {
        $spaces = Space::get_spaces_visible($request);

        echo json_encode($spaces);
    });

    Route::get('all_spaces', function () {
        $spaces = Space::all();

        echo json_encode($spaces);
    });

    Route::get('all_space_bookings', function () {
        $space_bookings = SpaceBooking::all();

        echo json_encode($space_bookings);
    });

    Route::get('services/services', function () {
        $services = Service::get_active_valid_services();

        echo json_encode($services);
    });

    Route::get('country_currency', function () {
        $space_id = Input::get('country_code');

        if($space_id != null) {
            $currency = Country::find($space_id)->currency;

            echo json_encode($currency);
        }
    });

    Route::get('manage_space_error_messages', function () {
        $error_messages = array(trans('management.error'), trans('management.pricetable_error_msg'), trans('management.timetable_error_msg'));

        echo json_encode($error_messages);
    });

    Route::get('manage_space_review_messages', function () {
        $error_messages = array(trans('management.error'), trans('management.rating_invalid'));

        echo json_encode($error_messages);
    });

    Route::get('services/spaces_popular', function () {
        $spaces = Space::get_all_spaces_by_popularity_avg();

        echo json_encode($spaces);
    });

    Route::get('services/services_popular', function () {
        $services = Service::get_all_services_by_popularity_avg();

        echo json_encode($services);
    });

    Route::resource('services', 'ServiceController');

    Route::resource('space_generic_extras', 'SpaceExtraGenericController');
    Route::get('spaces/validation', 'SpaceController@setValidation')->name('spaces.validation')->middleware('admin');
    Route::get('spaces/activation', 'SpaceController@setActivation')->name('spaces.activation')->middleware('space_managers');
    Route::post('spaces/sendEmail/{id}', 'SpaceController@sendEmail')->name('spaces.sendEmail')->middleware('auth');
    Route::resource('spaces', 'SpaceController', ['middleware' => 'space_managers']);
    Route::resource('space_photos', 'SpacePhotoController', ['middleware' => 'space_managers']);
    Route::resource('space_photos', 'SpacePhotoController', ['middleware' => 'space_managers']);
    Route::resource('space_reviews', 'SpaceReviewController', ['middleware' => 'space_review']);
    Route::get('space_bookings/allBookingsMySpaces', 'SpaceBookingController@allBookingsMySpaces')->name('space_bookings.allBookingsMySpaces');
    Route::resource('space_bookings', 'SpaceBookingController');
    Route::resource('space_booking_details', 'SpaceBookingDetailController');

    Route::resource('action_types', 'ActionTypeController');
    Route::resource('business_verticals', 'BusinessVerticalController');
    Route::resource('currencies', 'CurrencyController');
    Route::resource('countries', 'CountryController');
    Route::resource('distance_units', 'DistanceUnitController');
    Route::resource('payment_plan_types', 'PaymentPlanTypeController');
    Route::resource('space_types', 'SpaceTypeController');
    Route::resource('users', 'UserController');
});