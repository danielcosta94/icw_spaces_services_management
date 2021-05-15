<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PaymentPlanTypeController extends Controller
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
        $payment_plan_types = PaymentPlanType::paginate(10);
        return view('admin.payment_plan_types.index', compact('payment_plan_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_plan_types.create');
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
            'plan' => 'required|string|max:15|unique:payment_plan_types'
        ];

        $payment_plan_type_info = Input::all();
        $validation = Validator::make($payment_plan_type_info, $rules);

        if ($validation->passes()) {
            PaymentPlanType::create($payment_plan_type_info);

            return Redirect::route('payment_plan_types.index')
                ->with('message', trans('management.payment_plan_type_added_msg'));
        } else {
            return Redirect::route('payment_plan_types.create')
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
        $payment_plan_type = PaymentPlanType::find($id);

        if (!is_null($payment_plan_type)) {
            return view('admin.payment_plan_types.show', compact('payment_plan_type'));
        } else {
            return Redirect::route('payment_plan_types.index')
                ->with('message-error', trans('management.payment_plan_type_not_found_msg'));
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
        $payment_plan_type = PaymentPlanType::find($id);

        if (!is_null($payment_plan_type)) {
            return view('admin.payment_plan_types.edit', compact('payment_plan_type'));
        } else {
            return Redirect::route('payment_plan_types.index')
                ->with('message-error', trans('management.payment_plan_type_not_found_msg'));
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
        $payment_plan_type = PaymentPlanType::find($id);

        if (!is_null($payment_plan_type)) {
            $rules = [
                'plan' => 'required|string|max:15'
            ];

            $payment_plan_type_info = Input::all();
            $validation = Validator::make($payment_plan_type_info, $rules);

            if ($validation->passes()) {
                $payment_plan_type->update($payment_plan_type_info);
                return Redirect::route('payment_plan_types.index')
                    ->withInput()
                    ->with('message', trans('management.payment_plan_type_updated_msg'));

            } else {
                return Redirect::route('payment_plan_types.edit', $payment_plan_type)
                    ->withInput()
                    ->withErrors($validation);

            }
        } else {
            return Redirect::route('payment_plan_types.index')
                ->with('message-error', trans('management.payment_plan_type_not_found_msg'));
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
        $payment_plan_type = PaymentPlanType::find($id);

        if (!is_null($payment_plan_type)) {
            try {
                $payment_plan_type->forceDelete();
                return Redirect::route('payment_plan_types.index')
                    ->with('message', trans('management.payment_plan_type_deleted_msg'));
            } catch (\PDOException $queryException) {
                return Redirect::route('payment_plan_types.index')
                    ->with('message-error', trans('management.payment_plan_type_usage_msg'));
            }
        } else {
            return Redirect::route('payment_plan_types.index')
                ->with('message-error', trans('management.payment_plan_type_not_found_msg'));
        }
    }
}
