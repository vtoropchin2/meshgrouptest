<?php declare(strict_types=1);


namespace App\Services;


use App\Category;
use Kalnoy\Nestedset\Collection;

/**
 * Interface CategoryServiceInterface
 * @package App\Services
 */
interface CategoryServiceInterface
{
    /**
     * @param string   $name
     * @param int|null $parentCategoryId
     *
     * @return Category
     */
    public function createCategory(string $name, int $parentCategoryId = null): Category;

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public function getCategory(int $categoryId): ?Category;

    /**
     * @param int|null $parentCategoryId
     *
     * @return Collection
     */
    public function getCategories(?int $parentCategoryId): Collection;

    /**
     * @param int    $categoryId
     * @param string $name
     *
     * @return Category
     */
    public function updateCategory(int $categoryId, string $name): Category;

    /**
     * @param int $categoryId
     *
     * @return mixed
     */
    public function deleteCategory(int $categoryId): void;
}
