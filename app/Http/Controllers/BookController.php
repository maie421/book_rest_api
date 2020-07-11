<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;


class BookController extends Controller
{
    public function index()
    {
      
      // return BookResource::collection(Book::with('ratings')->paginate(25));
      return BookResource::collection(Book::all());
      // return Book::all();
      // return new BookResource();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'score' => 'required',
            'body' => 'required',
            'isbn' => 'required',
        ]);
        $book = new Book;
        // $book->user_id = $request->user()->id;
        $book->user_id =  $request->user_id;
        $book->score = $request->score;
        $book->body = $request->body;
        $book->isbn = $request->isbn;
        $book->save();
        return new BookResource($book);
}

    public function show($book)//isbn 책기준 리뷰
    {
      $book = Book::where('isbn', $book)
               ->orderBy('created_at', 'desc')
               ->get();
        // return new BookResource($book);
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

    public function destroy(Request $request,Book $book)
    {
      if($request->user()->id != $book->user_id){
        return response()->json(['error' => 'You can only delete your own books.'], 403);
      }
        $book ->delete();
        return response()->json(null,204);
    }




}
