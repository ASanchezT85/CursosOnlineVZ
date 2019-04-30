<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($course){
                return [
                    'id'                => $course->id,
                    'teacher_id'        => $course->teacher_id,
                    'category_id'       => $course->category_id,
                    'level_id'          => $course->level_id,
                    'name'              => $course->name,
                    'description'       => $course->description,
                    'slug'              => $course->slug,
                    'picture'           => $course->picture,
                    'status'            => $course->status,
                    'previous_approved' => $course->previous_approved,
                    'previous_rejected' => $course->previous_rejected,
                ];
            })
        ];
    }
}
