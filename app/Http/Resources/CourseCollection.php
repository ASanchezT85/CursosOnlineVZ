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
                    'teacher'           => $course->teacher->user->name,
                    'category'          => $course->category->name,
                    'level'             => __($course->level->name),
                    'name'              => $course->name,
                    'description'       => $course->description,
                    'amount'            => $course->amount,
                    'slug'              => $course->slug,
                    'picture'           => $course->pathAttachment(),
                    'status'            => $course->status->name,
                    'status_id'         => $course->status->id,
                    'previous_approved' => $course->previous_approved,
                    'previous_rejected' => $course->previous_rejected,
                    'created'           => $course->created_at->format('Ymd'),
                    'update'            => $course->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
