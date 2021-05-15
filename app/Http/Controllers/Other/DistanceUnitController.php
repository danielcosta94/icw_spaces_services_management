<?php

namespace App\Http\Controllers;

use App\Models\DistanceUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DistanceUnitController extends Controller
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
        $distance_units = DistanceUnit::paginate(10);
        return view('admin.distance_units.index', compact('distance_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.distance_units.create');
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
            'symbol' => 'required|string|max:5|unique:distance_units',
            'description' => 'required|string|max:15|unique:distance_units',
        ];

        $distance_unit_info = Input::all();
        $validation = Validator::make($distance_unit_info, $rules);

        if ($validation->passes()) {
            DistanceUnit::create($distance_unit_info);

            return Redirect::route('distance_units.index')
                ->with('message', trans('management.distance_unit_added_msg'));
        } else {
            return Redirect::route('distance_units.create')
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
        $distance_unit = DistanceUnit::find($id);

        if (!is_null($distance_unit)) {
            return view('admin.distance_units.show', compact('distance_unit'));
        } else {
            return Redirect::route('distance_units.index')
                ->with('message-error', trans('management.distance_unit_not_found_msg'));
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
        $distance_unit = DistanceUnit::find($id);

        if (!is_null($distance_unit)) {
            return view('admin.distance_units.edit', compact('distance_unit'));
        } else {
            return Redirect::route('distance_units.index')
                ->with('message-error', trans('management.distance_unit_not_found_msg'));
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
        $distance_unit = DistanceUnit::find($id);

        if (!is_null($distance_unit)) {
            $rules = [
                'symbol' => 'required|string|max:5',
                'description' => 'required|string|max:15',
            ];

            $distance_unit_info = Input::all();
            $validation = Validator::make($distance_unit_info, $rules);

            if ($validation->passes()) {
                $distance_unit->update($distance_unit_info);

                return Redirect::route('distance_units.index')
                    ->withInput()
                    ->with('message', trans('management.distance_unit_updated_msg'));

            } else {
                return Redirect::route('distance_units.edit', $distance_unit)
                    ->withInput()
                    ->withErrors($validation);

            }
        } else {
            return Redirect::route('distance_units.index')
                ->with('message-error', trans('management.distance_unit_not_found_msg'));
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
        $distance_unit = DistanceUnit::find($id);

        if (!is_null($distance_unit)) {
            try {
                $distance_unit->forceDelete();
                return Redirect::route('distance_units.index')
                    ->with('message', trans('management.distance_unit_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('distance_units.index')
                    ->with('message-error', trans('management.distance_unit_usage_msg'));
            }
        } else {
            return Redirect::route('distance_units.index')
                ->with('message-error', trans('management.distance_unit_not_found_msg'));
        }
    }
}
