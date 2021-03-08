<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
			'id' => $this->id,
            'child' => !is_null($this->parent_id),
			'username' => $this->username,
			'comment' => $this->comment,
            'created_at' => $this->created_at->diffForHumans(),
            'parent_id' => $this->parent_id,
			'children' => CommentResource::collection($this->whenLoaded('children')),
		];

    }
}
