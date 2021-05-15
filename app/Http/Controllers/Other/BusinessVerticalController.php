<?php

namespace App\Http\Controllers;

use App\Models\BusinessVertical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BusinessVerticalController extends Controller
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
        $verticals = BusinessVertical::paginate(10);
        return view('admin.business_verticals.index', compact('verticals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.business_verticals.create');
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
            'name' => 'required|string|max:60|unique:business_verticals',
        ];

        $vertical_info = Input::all();
        $validation = Validator::make($vertical_info, $rules);

        if ($validation->passes()) {
            BusinessVertical::create($vertical_info);

            return Redirect::route('business_verticals.index')
                ->with('message', trans('management.business_verticals_added_msg'));
        } else {
            return Redirect::route('business_verticals.create')
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
        $vertical = BusinessVertical::find($id);

        if (!is_null($vertical)) {
            return view('admin.business_verticals.show', compact('vertical'));
        } else {
            return Redirect::route('business_verticals.index')
                ->with('message-error', trans('management.business_verticals_not_found_msg'));
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
        $vertical = BusinessVertical::find($id);

        if (!is_null($vertical)) {
            return view('admin.business_verticals.edit', compact('vertical'));
        } else {
            return Redirect::route('business_verticals.index')
                ->with('message-error', trans('management.business_verticals_not_found_msg'));
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
        $vertical = BusinessVertical::find($id);

        if (!is_null($vertical)) {
            $rules = [
                'name' => 'required|string|max:60',
            ];
            $vertical_info = Input::all();
            $validation = Validator::make($vertical_info, $rules);

            if ($validation->passes()) {
                $vertical->update($vertical_info);
                return Redirect::route('business_verticals.index')
                    ->withInput()
                    ->with('message', trans('management.business_verticals_updated_msg'));

            } else {
                return Redirect::route('business_verticals.edit', $vertical)
                    ->withInput()
                    ->withErrors($validation);

            }
        } else {
            return Redirect::route('business_verticals.index')
                ->with('message-error', trans('management.business_verticals_not_found_msg'));
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
        $vertical = BusinessVertical::find($id);

        if (!is_null($vertical)) {
            try {
                $vertical->forceDelete();
                return Redirect::route('business_verticals.index')
                    ->with('message', trans('management.business_verticals_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('business_verticals.index')
                    ->with('message-error', trans('management.business_verticals_usage_msg'));
            }
        } else {
            return Redirect::route('business_verticals.index')
                ->with('message-error', trans('management.business_verticals_not_found_msg'));
        }
    }
}