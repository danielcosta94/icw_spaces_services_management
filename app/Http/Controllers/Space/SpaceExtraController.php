<?php

namespace App\Http\Controllers;

use App\Models\SpaceExtra;
use App\Models\SpaceExtrasGeneric;
use Illuminate\Http\Request;

class SpaceExtraController extends Controller
{
    public static function rules()
    {
        $rules = array();
        $space_extras = SpaceExtra::all();

        foreach ($space_extras as $space_extra) {
            $key = 'extra_id_' . $space_extra->id;
            $value = 'required';
            array_add($rules, $key, $value);
        }
        return $rules;
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
        $space_extras_generic = SpaceExtrasGeneric::all();

        foreach ($space_extras_generic as $space_extra_generic) {
            if($request->has('extra_id_' . $space_extra_generic->id) ) {
                SpaceExtra::create([
                    'space_id' => $space_id,
                    'space_extra_id' => $space_extra_generic->id,
                ]);
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
        $space_extras_generic = SpaceExtrasGeneric::all();

        foreach ($space_extras_generic as $space_extra_generic) {

            $space_extra = SpaceExtra::where('space_id', $space_id)->where('space_extra_id', $space_extra_generic->id)->first();

            if(is_null($space_extra)) {
                if($request->has('extra_id_' . $space_extra_generic->id) ) {
                    SpaceExtra::create([
                        'space_id' => $space_id,
                        'space_extra_id' => $space_extra_generic->id,
                    ]);
                }
            } else {
                if(!$request->has('extra_id_' . $space_extra_generic->id) ) {
                    $space_extra->forceDelete();
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
