<?php

namespace App\Http\Controllers;

use App\Models\ActionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ActionTypeController extends Controller
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
        $actions = ActionType::paginate(10);
        return view('admin.action_types.index', compact('actions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.action_types.create');
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
            'action' => 'required|string|max:30|unique:action_types',
        ];

        $action_info = Input::all();
        $validation = Validator::make($action_info, $rules);

        if ($validation->passes()) {
            ActionType::create($action_info);

            return Redirect::route('action_types.index')
                ->with('message', trans('management.action_types_added_msg'));
        } else {
            return Redirect::route('action_types.create')
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
        $action = ActionType::find($id);

        if (!is_null($action)) {
            return view('admin.action_types.show', compact('action'));
        } else {
            return Redirect::route('action_types.index')
                ->with('message-error', trans('management.action_types_not_found_msg'));
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
        $action = ActionType::find($id);

        if (!is_null($action)) {
            return view('admin.action_types.edit', compact('action'));
        } else {
            return Redirect::route('action_types.index')
                ->with('message-error', trans('management.action_types_not_found_msg'));
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
        $action = ActionType::find($id);

        if (!is_null($action)) {
            $rules = [
                'action' => 'required|string|max:30',
            ];
            $action_info = Input::all();
            $validation = Validator::make($action_info, $rules);

            if ($validation->passes()) {
                $action->update($action_info);
                return Redirect::route('action_types.index')
                    ->withInput()
                    ->with('message', trans('management.action_types_updated_msg'));

            } else {
                return Redirect::route('action_types.edit', $action)
                    ->withInput()
                    ->withErrors($validation);

            }
        } else {
            return Redirect::route('action_types.index')
                ->with('message-error', trans('management.action_types_not_found_msg'));
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
        $action = ActionType::find($id);

        if (!is_null($action)) {
            try {
                $action->forceDelete();
                return Redirect::route('action_types.index')
                    ->with('message', trans('management.action_types_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('action_types.index')
                    ->with('message-error', trans('management.action_types_usage_msg'));
            }
        } else {
            return Redirect::route('action_types.index')
                ->with('message-error', trans('management.action_types_not_found_msg'));
        }
    }
}