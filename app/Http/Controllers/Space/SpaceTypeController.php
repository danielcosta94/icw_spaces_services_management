<?php

namespace App\Http\Controllers;

use App\Models\SpaceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SpaceTypeController extends Controller
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
        $space_types = SpaceType::paginate(10);
        return view('space_manager.space_types.index', compact('space_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('space_manager.space_types.create');
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
            'space_type' => 'required|string|max:45|unique:space_types',
            'description' => 'required|string|max:500'
        ];

        $space_type_info = Input::all();
        $validation = Validator::make($space_type_info, $rules);

        if ($validation->passes()) {
            SpaceType::create($space_type_info);

            return Redirect::route('space_types.index')
                ->with('message', trans('management_spaces.space_type_added_msg'));
        } else {
            return Redirect::route('space_types.create')
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
        $space_type = SpaceType::find($id);

        if (!is_null($space_type)) {
            return view('space_manager.space_types.show', compact('space_type'));
        } else {
            return Redirect::route('space_types.index')
                ->with('message-error', trans('management_spaces.space_type_not_found_msg'));
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
        $space_type = SpaceType::find($id);

        if (!is_null($space_type)) {
            return view('space_manager.space_types.edit', compact('space_type'));
        } else {
            return Redirect::route('space_types.index')
                ->with('message-error', trans('management_spaces.space_type_not_found_msg'));
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
        $space_type = SpaceType::find($id);

        if (!is_null($space_type)) {
            $rules = [
                'space_type' => 'required|string|max:45',
                'description' => 'required|string|max:500'
            ];
            $space_type_info = Input::all();
            $validation = Validator::make($space_type_info, $rules);

            if ($validation->passes()) {
                $space_type->update($space_type_info);
                return Redirect::route('space_types.index')
                    ->withInput()
                    ->with('message', trans('management_spaces.space_type_updated_msg'));

            } else {
                return Redirect::route('space_types.edit', $space_type)
                    ->withInput()
                    ->withErrors($validation);

            }
        } else {
            return Redirect::route('space_types.index')
                ->with('message-error', trans('management_spaces.space_type_not_found_msg'));
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
        $space_type = SpaceType::find($id);

        if (!is_null($space_type)) {
            try {
                $space_type->forceDelete();
                return Redirect::route('space_types.index')
                    ->with('message', trans('management_spaces.space_type_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('space_types.index')
                    ->with('message-error', trans('management_spaces.space_type_usage_msg'));
            }
        } else {
            return Redirect::route('space_types.index')
                ->with('message-error', trans('management_spaces.space_type_not_found_msg'));
        }
    }
}
