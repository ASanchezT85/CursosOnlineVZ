<?php

namespace App\Http\Resources\Administration;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LevelCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($levels){
                return [
                    'id'                => $levels->id,
                    'name'              => __($levels->name),
                    'description'       => $levels->description,
                    'created'           => $levels->created_at->format('Ymd'),
                    'updated'           => $levels->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
