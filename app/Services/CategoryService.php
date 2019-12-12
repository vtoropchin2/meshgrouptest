<?php declare(strict_types=1);


namespace App\Services;


use App\Category;
use Kalnoy\Nestedset\Collection;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService extends AbstractService implements CategoryServiceInterface
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * CategoryService constructor.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param string   $name
     * @param int|null $parentCategoryId
     *
     * @return Category
     */
    public function createCategory(string $name, int $parentCategoryId = null): Category
    {
        $parentCategory = null;
        if ($parentCategoryId !== null) {
            $parentCategory = Category::find($parentCategoryId);
        }

        $category = Category::create(
            [
                'name' => $name,
            ],
            $parentCategory
        );

        return $category;
    }

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public function getCategory(int $categoryId): ?Category
    {
        return Category::find($categoryId);
    }

    /**
     * @param int|null $parentCategoryId
     *
     * @return Collection
     */
    public function getCategories(?int $parentCategoryId): Collection
    {
        return Category::where('parent_id', $parentCategoryId)->get();
    }

    /**
     * @param int    $categoryId
     *
     * @param string $name
     *
     * @return Category
     */
    public function updateCategory(int $categoryId, string $name): Category
    {
        $category = Category::find($categoryId);
        $category->update(
            [
                'name' => $name,
            ]
        );

        return $category;
    }

    /**
     * @param int $categoryId
     *
     * @throws \Exception
     */
    public function deleteCategory(int $categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        $products = $category->products;

        foreach ($products as $product) {
            $this->productService->deleteProduct($product->id);
        }

        $category->delete();
    }

    /**
     * @param $categoryId
     *
     * @return Collection
     */
    public function getAncestors($categoryId): Collection
    {
        return Category::ancestorsAndSelf($categoryId);
    }
}
