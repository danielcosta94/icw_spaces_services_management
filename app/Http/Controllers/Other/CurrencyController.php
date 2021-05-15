<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
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
        $currencies = Currency::paginate(10);
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create');
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
            'code' => 'required|string|max:5|unique:currencies',
            'name' => 'required|string|max:45|unique:currencies',
            'symbol' => 'required|string|max:3|unique:currencies'
        ];

        $currency_info = Input::all();
        $validation = Validator::make($currency_info, $rules);

        if ($validation->passes()) {
            Currency::create($currency_info);

            return Redirect::route('currencies.index')
                ->with('message', trans('management.currency_added_msg'));
        } else {
            return Redirect::route('currencies.create')
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
        $currency = Currency::find($id);

        if (!is_null($currency)) {
            return view('admin.currencies.show', compact('currency'));
        } else {
            return Redirect::route('currencies.index')
                ->with('message-error', trans('management.currency_not_found_msg'));
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
        $currency = Currency::find($id);

        if (!is_null($currency)) {
            return view('admin.currencies.edit', compact('currency'));
        } else {
            return Redirect::route('currencies.index')
                ->with('message-error', trans('management.currency_not_found_msg'));
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
        $currency = Currency::find($id);

        if (!is_null($currency)) {
            $rules = [
                'code' => 'required|string|max:5',
                'name' => 'required|string|max:45',
                'symbol' => 'required|string|max:3'
            ];
            $currency_info = Input::all();
            $validation = Validator::make($currency_info, $rules);

            if ($validation->passes()) {
                $currency->update($currency_info);
                return Redirect::route('currencies.index')
                    ->withInput()
                    ->with('message', trans('management.currency_updated_msg'));

            } else {
                return Redirect::route('currencies.edit', $currency)
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
        $currency = Currency::find($id);

        if (!is_null($currency)) {
            try {
                $currency->forceDelete();
                return Redirect::route('currencies.index')
                    ->with('message', trans('management.currency_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('currencies.index')
                    ->with('message-error', trans('management.currency_usage_msg'));
            }
        } else {
            return Redirect::route('currencies.index')
                ->with('message-error', trans('management.currency_not_found_msg'));
        }
    }
}
