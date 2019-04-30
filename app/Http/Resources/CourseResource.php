<?php

namespace App\Http\Resources;

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
            'slug'              => $this->slug,
            'picture'           => $this->picture,
            'status'            => $this->status,
            'previous_approved' => $this->previous_approved,
            'previous_rejected' => $this->previous_rejected,
        ];
    }
}
