<?php

namespace App\Http\Controllers;

use App\Models\SpaceExtrasGeneric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SpaceExtraGenericController extends Controller
{
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
        $space_generic_extras = SpaceExtrasGeneric::paginate(10);
        return view('space_manager.space_generic_extras.index', compact('space_generic_extras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('space_manager.space_generic_extras.create');
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
            'name' => 'required|string|max:60|unique:space_extras_generics',
            'description' => 'required|string|max:200'
        ];

        $space_generic_extra = Input::all();
        $validation = Validator::make($space_generic_extra, $rules);

        if ($validation->passes()) {
            SpaceExtrasGeneric::create($space_generic_extra);

            return Redirect::route('space_generic_extras.index')
                ->with('message', trans('management_spaces.space_generic_extra_added_msg'));
        } else {
            return Redirect::route('space_generic_extras.create')
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
        $space_generic_extra = SpaceExtrasGeneric::find($id);

        if (!is_null($space_generic_extra)) {
            return view('space_manager.space_generic_extras.show', compact('space_generic_extra'));
        } else {
            return Redirect::route('space_generic_extras.index')
                ->with('message-error', trans('management_spaces.space_generic_extra_not_found_msg'));
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
        $space_generic_extra = SpaceExtrasGeneric::find($id);

        if (!is_null($space_generic_extra)) {
            return view('space_manager.space_generic_extras.edit', compact('space_generic_extra'));
        } else {
            return Redirect::route('space_generic_extras.index')
                ->with('message-error', trans('management_spaces.space_generic_extra_not_found_msg'));
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
        $space_generic_extra = SpaceExtrasGeneric::find($id);

        if (!is_null($space_generic_extra)) {
            $rules = [
                'name' => 'required|string|max:60',
                'description' => 'required|string|max:200'
            ];
            $space_generic_extra_info = Input::all();
            $validation = Validator::make($space_generic_extra_info, $rules);

            if ($validation->passes()) {
                try {
                    $space_generic_extra->update($space_generic_extra_info);
                    return Redirect::route('space_generic_extras.index')
                        ->withInput()
                        ->with('message', trans('management_spaces.space_generic_extra_updated_msg'));
                } catch (\PDOException $queryException) {
                    return Redirect::route('space_generic_extras.index')
                        ->with('message-error', trans('management_spaces.space_generic_extra_usage_msg'));
                }
            } else {
                return Redirect::route('space_generic_extras.edit', $space_generic_extra)
                    ->withInput()
                    ->withErrors($validation);

            }
        } else {
            return Redirect::route('space_generic_extras.index')
                ->with('message-error', trans('management_spaces.space_generic_extra_not_found_msg'));
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
        $space_generic_extra = SpaceExtrasGeneric::find($id);

        if (!is_null($space_generic_extra)) {
            try {
                $space_generic_extra->forceDelete();
                return Redirect::route('space_generic_extras.index')
                    ->with('message', trans('management_spaces.space_generic_extra_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('space_generic_extras.index')
                    ->with('message-error', trans('management_spaces.space_generic_extra_usage_msg'));
            }
        } else {
            return Redirect::route('space_generic_extras.index')
                ->with('message-error', trans('management_spaces.space_generic_extra_not_found_msg'));
        }
    }
}
