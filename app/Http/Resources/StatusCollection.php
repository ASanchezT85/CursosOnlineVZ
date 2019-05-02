<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($status){
                return [
                    'id'                => $status->id,
                    'name'              => $status->name,
                    'description'       => $status->description,
                    'created'           => $status->created_at->format('Ymd'),
                    'updated'           => $status->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
