<?php

namespace App\Http\Resources\Administration;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($student){
                return [
                    'id'        => $student->id,
                    'user_id'   => $student->user_id,
                    'name'      => $student->user->name,
                    'courses'   => $student->courses,
                    'created'   => $student->user->created_at->format('Ymd'),
                    'updated'   => $student->user->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
