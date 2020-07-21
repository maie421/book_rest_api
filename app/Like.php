<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['book_id','user_id'];

    public function Book(){
        return $this->belongsTo(Book::class);
    }
}
