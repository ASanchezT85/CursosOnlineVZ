<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CoursesCollection extends ResourceCollection
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
                    'teacher'           => $course->teacher->user->name,
                    'category'          => $course->category->name,
                    'name'              => $course->name,
                    'slug'              => $course->slug,
                    'amount'            => $course->amount,
                    'status'            => __($course->status->name),
                    'created'           => $course->created_at->format('Ymd'),
                    'update'            => $course->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
