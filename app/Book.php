<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable =['user_id','score','isbn','body'];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Ratings(){
        return $this->hasMany(Rating::class);
    }
}
