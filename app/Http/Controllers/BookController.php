<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Rating;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
      
      return BookResource::collection(Book::all()->sortByDesc('created_at'));
    }

    public function store(Request $request)
    {

        $book = new Book;
        // $book->user_id = $request->user()->id;
        $book->user_id =  $request->user_id;
        $book->score = $request->score;
        $book->body = $request->body;
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->thumbnail = $request->thumbnail;
        $book->authors = $request->authors;
        $book->contents = $request->contents;
        $book->publisher = $request->publisher;
        $book->save();
        
        // return response()->json(['message'=>'Successfully logged out']);
        return new BookResource($book);
    }

    // public function show($book)//isbn 책기준 리뷰
    // {
    //   $book = Book::where('isbn', $book)
    //            ->orderBy('created_at', 'desc')
    //            ->get();

    //     return new BookResource($book);
    //     // return response()->json($book);
    // }

    public function show($book)//isbn 책기준 리뷰
    {

      $book = Book::where('isbn', $book)
            ->orderBy('created_at', 'desc')
            ->get();
            // $book = $user_id->fresh('user');
        return response()->json($book);
    }

    public function update(Request $request, Book $book)

    {

      // check if currently authenticated user is the owner of the book

      if ($request->user_id != $book->user_id) {

        return response()->json(['error' => 'You can only edit your own books.'], 403);

      }

      $book->update($request->only(['body','score']));

      return new BookResource($book);
    }

    public function emotionupdate(Request $request,Book $book)
    {
      $book->update($request->only(['emotion']));

      return new BookResource($book);
    }

    public function destroy(Request $request,Book $book)
    {
      if($request->user_id != $book->user_id){
        return response()->json(['error' => 'You can only delete your own books.'], 403);
      }

        Like::where('book_id',$book->id)->delete();
        Rating::where('book_id',$book->id)->delete();
        $book ->delete();
        return response()->json(null,204);
    }




}
