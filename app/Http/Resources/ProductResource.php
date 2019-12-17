<?php declare(strict_types=1);

namespace App\Http\Resources;

use App\Photo;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource
 * @property int id
 * @property string name
 * @property string description
 * @property Photo|null photo
 * @package App\Http\Resources
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $fileName = $this->photo->file_name ?? null;
        $photoUrl = null;
        if ($fileName) {
            $photoUrl = url('images/' . $this->photo->file_name);
        }

        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'photo'       => [
                'id'       => $this->photo->id ?? null,
                'fileName' => $photoUrl,
            ],
        ];
    }
}
