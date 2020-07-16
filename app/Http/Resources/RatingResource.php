<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            // 'user_id' =>  UserResource::collection($this->user_id),
            'user_id'=> $this->user_id,
            'user' => $this->user,
            'book_id'=> $this->book_id,
            'rating'=>$this->rating,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            // 'book' => $this->book,
        ];
    }
}
