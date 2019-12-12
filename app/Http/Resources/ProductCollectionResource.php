<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class ProductCollectionResource
 * @package App\Http\Resources
 */
class ProductCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $products = [];

        foreach ($this as $product) {
            $products[] = ProductResource::make($product);
        }

        return $products;
    }
}
