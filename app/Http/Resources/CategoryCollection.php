<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($category){
                return [
                    'id'                => $category->id,
                    'name'              => $category->name,
                    'picture'           => $category->pathAttachment(),
                    'created'           => $category->created_at->format('Ymd'),
                    'updated'            => $category->updated_at->format('Ymd'),
                ];
            })
        ];
    }
}
