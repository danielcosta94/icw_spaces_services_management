<?php

namespace App\Http\Controllers;

use App\Models\SpaceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SpaceReviewController extends Controller
{
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
    public function store(Request $request)
    {
        $rules = [
            'space_id' => 'required|integer|exists:spaces,id|unique:space_reviews,space_id,NULL,id,user_id,' . Auth::user()->id,
            'comment' => 'required|string|max:300',
            'rating' => 'required|integer|between:1,5',
        ];
        $review_info = Input::all();
        $validation = Validator::make($review_info, $rules);

        if ($validation->passes()) {

            $space_review = new SpaceReview();
            $space_review->user_id = Auth::user()->id;
            $space_review->space_id = $request->space_id;
            $space_review->comment = $request->comment;
            $space_review->rating = $request->rating;

            $space_review->save();

            return Redirect::route('space-details', ['id' => $request->space_id])
                ->with('message', trans('management_spaces.space_review_added_msg'));
        } else {
            return Redirect::route('space-details', ['id' => $request->space_id])
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $space_review = SpaceReview::find($id);

        if (!is_null($space_review)) {
            if(Auth::user()->id == $space_review->user_id) {
                $rules = [
                    'space_id' => 'required|integer|exists:spaces,id',
                    'comment' => 'required|string|max:300',
                    'rating' => 'required|integer|between:1,5',
                ];
                $space_review_info = Input::all();
                $validation = Validator::make($space_review_info, $rules);

                if ($validation->passes()) {
                    $space_review->update($space_review_info);
                    return Redirect::route('space-details', ['id' => $space_review->space_id])
                        ->withInput()
                        ->with('message', trans('management_spaces.space_review_updated_msg'));

                } else {
                    return Redirect::route('space-details', ['id' => $space_review->space_id])
                        ->withInput()
                        ->withErrors($validation);
                }
            } else {
                return Redirect::route('space-details', ['id' => $space_review->space_id])
                    ->with('message-error', trans('management_spaces.space_review_no_permissions'));
            }
        } else {
            return Redirect::route('space-details', ['id' => $space_review->space_id])
                ->with('message-error', trans('management_spaces.space_review_not_found_msg'));
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
        $space_review = SpaceReview::find($id);

        if (!is_null($space_review)) {
            if(Auth::user()->id == $space_review->user_id) {
                $space_review->forceDelete();
                return Redirect::route('space-details', ['id' => $space_review->space_id])
                    ->with('message', trans('management_spaces.space_review_deleted_msg'));
            } else {
                return Redirect::route('space-details', ['id' => $space_review->space_id])
                    ->with('message-error', trans('management_spaces.space_review_no_permissions'));
            }
        } else {
            return Redirect::route('space-details', ['id' => $space_review->space_id])
                ->with('message-error', trans('management_spaces.space_review_not_found_msg'));
        }
    }
}
