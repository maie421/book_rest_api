<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'book_id' => 'required',
        ]);
        $count = Like::where('user_id',$request->user_id)->where('book_id',$request->book_id)->count();
        if($count>=1){
            return response()->json('중복');
        }
        $like = new Like;
        // $like->user_id = $request->user()->id;
        $like->user_id =   $request->user_id;
        $like->book_id =  $request->book_id;
        $like->save();
        return response()->json($like);
    }

    public function destroy(Request $request, Like $like)
    {
        if($request->user_id != $like->user_id){
          return response()->json(['error' => 'You can only delete your own books.'], 403);
        }
        $like ->delete();
        return response()->json(null,204);
    }
}
