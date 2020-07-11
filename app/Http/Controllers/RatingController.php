<?php

namespace App\Http\Controllers;
use App\Book;
use App\Rating;
use App\Http\Resources\RatingResource;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'user_id' => 'required',
            'rating' => 'required',
            // 'book_id' => 'required',
        ]);
        $rating = new Rating;
        // $rating->user_id = $request->user()->id;
        $rating->user_id = 1;
        $rating->rating =$request->rating;
        $rating->book_id = 1;
        $rating->save();

        return new RatingResource($rating);
    }
}
