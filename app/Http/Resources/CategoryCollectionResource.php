<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class CategoryCollectionResource
 * @package App\Http\Resources
 */
class CategoryCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $categories = [];

        foreach ($this as $category) {
            $categories[] = CategoryResource::make($category);
        }

        return $categories;
    }
}
