<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::paginate(10);
        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create');
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
            'code' => 'required|string|max:5|unique:countries',
            'name' => 'required|string|max:60|unique:countries',
            'currency_code' => 'required|string|max:5',
            'calling_code_id' => 'required|string|max:5|unique:countries',
            'flag_path' => 'required|image|mimes:png,jpg,jpeg|max:2000'
        ];
        $country_info = Input::all();
        $validation = Validator::make($country_info, $rules);

        if ($validation->passes()) {
            $filename = $request->flag_path->storeAs('public/images/countries_flags', $request->code . '.' . Input::file('flag_path')->getClientOriginalExtension());

            Country::create([
                'code' => $request->code,
                'name' => $request->name,
                'currency_code' => $request->currency_code,
                'calling_code_id' => $request->calling_code_id,
                'flag_path' => $filename,
            ]);

            return Redirect::route('countries.index')
                ->with('message', trans('management.country_added_msg'));
        } else {
            return Redirect::route('countries.create')
                ->withInput()
                ->withErrors($validation);
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
        $country = Country::find($id);

        if (!is_null($country)) {
            return view('admin.countries.show', compact('country'));
        } else {
            return Redirect::route('countries.index')
                ->with('message-error', trans('management.country_not_found_msg'));
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
        $country = Country::find($id);

        if (!is_null($country)) {
            return view('admin.countries.edit', compact('country'));
        } else {
            return Redirect::route('countries.index')
                ->with('message-error', trans('management.country_not_found_msg'));
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
        $country = Country::find($id);

        if (!is_null($country)) {
            $rules = [
                'code' => 'required|string|max:5',
                'name' => 'required|string|max:60',
                'currency_code' => 'required|string|max:5',
                'calling_code_id' => 'required|string|max:5',
                'flag_path' => 'image|mimes:png,jpg,jpeg|max:2000'
            ];

            $country_info = Input::all();

            $validation = Validator::make($country_info, $rules);
            if ($validation->passes()) {

                $country->code = $request->code;
                $country->name = $request->name;
                $country->currency_code = $request->currency_code;
                $country->calling_code_id = $request->calling_code_id;

                if($request->hasFile('flag_path')) {
                    Storage::delete($country->flag_path);

                    $filename = $request->flag_path->storeAs('public/images/countries_flags', $request->code . '.' . Input::file('flag_path')->getClientOriginalExtension());
                    $country->flag_path = $filename;
                    $country->update();

                    return Redirect::route('countries.index')
                        ->with('message', trans('management.country_updated_msg'));

                } else {
                    $country->update();

                    return Redirect::route('countries.index')
                        ->with('message', trans('management.country_updated_msg'));
                }
            } else {
                return Redirect::route('countries.edit', $country)
                    ->withInput()
                    ->withErrors($validation);
            }
        } else {
            return Redirect::route('currencies.index')
                ->with('message-error', trans('management.currency_not_found_msg'));
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
        $country = Country::find($id);

        if (!is_null($country)) {
            try {
                Storage::delete($country->flag_path);
                $country->forceDelete();
                return Redirect::route('countries.index')
                    ->with('message', trans('management.country_deleted_msg'));

            } catch (\PDOException $queryException) {
                return Redirect::route('countries.index')
                    ->with('message-error', trans('management.country_usage_msg'));
            }
        } else {
            return Redirect::route('countries.index')
                ->with('message-error', trans('management.country_not_found_msg'));
        }
    }
}
