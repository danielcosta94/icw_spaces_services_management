<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlanType;
use App\Models\SpacePricePlan;
use Illuminate\Http\Request;

class SpacePricePlanController extends Controller
{
    public static function rules()
    {
        return [
            'price_hour' => 'nullable|min:1',
            'price_day' => 'nullable||min:1',
            'price_week' => 'nullable||min:1',
            'price_month' => 'nullable|min:1',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $space_id)
    {
        $payment_plans_types = PaymentPlanType::all();

        foreach ($payment_plans_types as $payment_plan_type) {
            $price_plan =  $request->get('price_' . $payment_plan_type->plan);

            if($price_plan != null) {
                if ($request->has('price_' . $payment_plan_type->plan . '_check')) {
                    SpacePricePlan::create([
                        'space_id' => $space_id,
                        'payment_plan_type_id' => $payment_plan_type->id,
                        'active' => true,
                        'price' => $price_plan,
                    ]);
                } else {
                    SpacePricePlan::create([
                        'space_id' => $space_id,
                        'payment_plan_type_id' => $payment_plan_type->id,
                        'active' => false,
                        'price' => $price_plan,
                    ]);
                }
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $space_id)
    {
        $payment_plans_types = PaymentPlanType::all();

        foreach ($payment_plans_types as $payment_plan_type) {
            $price_plan = $request->get('price_' . $payment_plan_type->plan);

            $space_price_plan = SpacePricePlan::where('space_id', $space_id)->where('payment_plan_type_id', $payment_plan_type->id)->first();

            if(!is_null($space_price_plan)) {
                if($price_plan != null) {
                    if ($request->has('price_' . $payment_plan_type->plan . '_check')) {
                        $space_price_plan->active = true;
                    } else {
                        $space_price_plan->active = false;
                    }
                    $space_price_plan->price = $price_plan;
                    $space_price_plan->update();
                }
            } else {
                if($price_plan != null) {
                    if ($request->has('price_' . $payment_plan_type->plan . '_check')) {
                        SpacePricePlan::create([
                            'space_id' => $space_id,
                            'payment_plan_type_id' => $payment_plan_type->id,
                            'active' => true,
                            'price' => $price_plan,
                        ]);
                    } else {
                        SpacePricePlan::create([
                            'space_id' => $space_id,
                            'payment_plan_type_id' => $payment_plan_type->id,
                            'active' => false,
                            'price' => $price_plan,
                        ]);
                    }
                }
            }

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
        //
    }
}
