<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'body'=> $this->body,
            'score' => $this->score,
            'user' => $this->user,
            'ratings' =>  RatingResource::collection($this->ratings->sortByDesc('created_at')),
            // 'ratings' => $this->ratings,
            'Likes' => $this->Likes,
            'thumbnail' => $this->thumbnail,
            'isbn'=>$this->isbn,
            'title'=>$this->title,
            'authors' => $this->authors,
            'contents' => $this->contents,
            'publisher' => $this->publisher,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            // 'average_rating' => $this->ratings->avg('rating')
        ];
    }
}
