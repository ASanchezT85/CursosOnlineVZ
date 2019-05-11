<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'teacher_id'        => $this->teacher_id,
            'category_id'       => $this->category_id,
            'level_id'          => $this->level_id,
            'name'              => $this->name,
            'description'       => $this->description,
            'amount'            => $this->amount,
            'slug'              => $this->slug,
            'picture'           => $this->picture,
            'status_id'         => $this->status_id,
            'created'           => $this->created_at,
            'update'            => $this->updated_at,
        ];
    }
}
