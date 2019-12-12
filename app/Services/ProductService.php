<?php declare(strict_types=1);


namespace App\Services;


use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends AbstractService
{
    /**
     * @var PhotoService
     */
    protected $photoService;

    /**
     * ProductService constructor.
     *
     * @param PhotoService $photoService
     */
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    /**
     * @param int    $categoryId
     * @param string $name
     * @param string $description
     *
     * @return Product
     */
    public function createProduct(int $categoryId, string $name, string $description): Product
    {
        return Product::create(
            [
                'category_id' => $categoryId,
                'name'        => $name,
                'description' => $description,
            ]
        );
    }

    /**
     * @param int $categoryId
     *
     * @return Collection
     */
    public function getProductsByCategoryId(int $categoryId): Collection
    {
        return Product::where('category_id', $categoryId)->get();
    }

    /**
     * @param int    $productId
     * @param string $name
     * @param string $description
     *
     * @return Product
     */
    public function updateProduct(int $productId, string $name, string $description): Product
    {
        $product = Product::find($productId);
        $product->update(
            [
                'name'        => $name,
                'description' => $description,
            ]
        );

        return $product;
    }

    /**
     * @param int $productId
     *
     * @throws \Exception
     */
    public function deleteProduct(int $productId): void
    {
        $product = Product::findOrFail($productId);
        $productPhoto = $product->photo;

        if ($productPhoto !== null) {
            $this->photoService->deletePhoto($productPhoto->id);
        }

        $product->delete();
    }

    /**
     * @param int $productId
     * @param int $newCategoryId
     */
    public function moveProduct(int $productId, int $newCategoryId): void
    {
        Product::where('id', $productId)->update(
            [
                'category_id' => $newCategoryId,
            ]
        );
    }

    /**
     * @param int          $productId
     * @param UploadedFile $image
     *
     * @return Product
     */
    public function addProductPhoto(int $productId, UploadedFile $image): Product
    {
        $product = Product::findOrFail($productId);

        $photo = $this->photoService->createPhoto($image);

        $product->update(
            [
                'photo_id' => $photo->id,
            ]
        );

        return $product;

    }
}
