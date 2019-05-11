<?php

namespace App\Http\Resources\Administration;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TeacherCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($teacher){
                return [
                    'id'            => $teacher->id,
                    'user_id'       => $teacher->user_id,
                    'name'          => $teacher->user->name,
                    'courses'       => $teacher->courses,
                    'courses_count' => $teacher->courses_count,
                    'created'       => $teacher->user->created_at->format('Ymd'),
                    'updated'       => $teacher->user->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
