<?php

namespace App\Http\Controllers;

use App\Models\SpaceAvailabilty;
use Illuminate\Http\Request;

class SpaceAvailabilityController extends Controller
{
    public static function rules()
    {
        return [
            'monday_opening_hour' => 'required_if:monday_check,1|integer|between:0,23',
            'monday_closing_hour' => 'required_if:monday_check,1|integer|between:0,23',
            'tuesday_opening_hour' => 'required_if:tuesday_check,1|integer|between:0,23',
            'tuesday_closing_hour' => 'required_if:tuesday_check,1|integer|between:0,23',
            'wednesday_opening_hour' => 'required_if:wednesday_check,1|integer|between:0,23',
            'wednesday_closing_hour' => 'required_if:wednesday_check,1|integer|between:0,23',
            'thursday_opening_hour' => 'required_if:thursday_check,1|integer|between:0,23',
            'thursday_closing_hour' => 'required_if:thursday_check,1|integer|between:0,23',
            'friday_opening_hour' => 'required_if:friday_check,1|integer|between:0,23',
            'friday_closing_hour' => 'required_if:friday_check,1|integer|between:0,23',
            'saturday_opening_hour' => 'required_if:saturday_check,1|integer|between:0,23',
            'saturday_closing_hour' => 'required_if:saturday_check,1|integer|between:0,23',
            'sunday_opening_hour' => 'required_if:sunday_check,1|integer|between:0,23',
            'sunday_closing_hour' => 'required_if:sunday_check,1|integer|between:0,23',
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
        $week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

        foreach ($week_days as $week_day) {
            if ($request->has($week_day . '_check')) {
                $opening_hour = $request->get($week_day . '_opening_hour');
                $closing_hour = $request->get($week_day . '_closing_hour');

                if($opening_hour >= 0 && $opening_hour <= 23 && $closing_hour >= 0 && $closing_hour <= 23) {
                    if($opening_hour < $closing_hour) {
                        SpaceAvailabilty::create([
                            'space_id' => $space_id,
                            'day_week' => $week_day,
                            'opening_hour' => $opening_hour,
                            'closing_hour' => $closing_hour,
                        ]);
                    }
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
        $week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

        foreach ($week_days as $week_day) {
            $opening_hour = $request->get($week_day . '_opening_hour');
            $closing_hour = $request->get($week_day . '_closing_hour');

            if ($opening_hour >= 0 && $opening_hour <= 23 && $closing_hour >= 0 && $closing_hour <= 23) {
                if ($opening_hour < $closing_hour) {

                    $space_availability = SpaceAvailabilty::where('space_id', $space_id)->where('day_week', $week_day)->first();

                    if($space_availability != null) {
                        if ($request->has($week_day . '_check')) {

                            $space_availability->opening_hour = $opening_hour;
                            $space_availability->closing_hour = $closing_hour;

                            $space_availability->update();
                        } else {
                            $space_availability->delete();
                        }
                    } else {
                        if ($request->has($week_day . '_check')) {
                            SpaceAvailabilty::create([
                                'space_id' => $space_id,
                                'day_week' => $week_day,
                                'opening_hour' => $opening_hour,
                                'closing_hour' => $closing_hour,
                            ]);
                        }
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
