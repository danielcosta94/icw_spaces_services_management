<?php

namespace App\Http\Controllers;

use App\Models\SpacePhoto;
use Illuminate\Http\Request;

class SpacePhotoController extends Controller
{
    public static function rules($request)
    {
        $rules = array();
        $photos = count($request['photos']);
        foreach(range(0, $photos) as $index) {
            $key = 'photos_' . $index;
            $value = 'image|mimes:png,jpg,jpeg';
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
        $is_main = true;
        foreach ($request->photos as $photo) {
            $filename = null;
            try {
                $filename = $photo->store('public/images/spaces/');
                if ($is_main) {
                    SpacePhoto::create([
                        'photo_type' => 'main',
                        'space_id' => $space_id,
                        'path' => $filename,
                    ]);
                    $is_main = false;
                } else {
                    SpacePhoto::create([
                        'photo_type' => 'secondary',
                        'space_id' => $space_id,
                        'path' => $filename,
                    ]);
                }
            } catch (\Exception $exception) {
                $filename->forceDelete();
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
    public function update(Request $request, $id)
    {
        //
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
