<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\GetCategoryListRequest;
use App\Http\Requests\GetCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollectionResource;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Response;

/**
 * Class CategoryApiController
 * @package App\Http\Controllers
 */
class CategoryApiController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryApiController constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param GetCategoryListRequest $request
     *
     * @return Response
     */
    public function getCategoryList(GetCategoryListRequest $request): Response
    {
        $parentCategoryId = $request->get('parentCategoryId');
        $categories = $this->categoryService->getCategories($parentCategoryId);

        $data = CategoryCollectionResource::make($categories);

        return $this->success($data);
    }

    /**
     * @param StoreCategoryRequest $request
     *
     * @return Response
     */
    public function createCategory(StoreCategoryRequest $request): Response
    {
        $parentCategoryId = $request->get('parentCategoryId');
        $name = $request->get('name');

        $category = $this->categoryService->createCategory($name, $parentCategoryId);

        $data = CategoryResource::make($category);

        return $this->success($data);
    }

    /**
     * @param GetCategoryRequest $request
     *
     * @return Response
     */
    public function getCategory(GetCategoryRequest $request): Response
    {
        $categoryId = $request->get('categoryId');
        $categories = $this->categoryService->getCategory($categoryId);

        $data = [];
        if ($categories !== null) {
            $data = CategoryResource::make($categories);
        }

        return $this->success($data);
    }

    /**
     * @param GetCategoryRequest $request
     *
     * @return Response
     */
    public function getAncestors(GetCategoryRequest $request): Response
    {
        $categoryId = $request->get('categoryId');
        $categories = $this->categoryService->getAncestors($categoryId);

        $data = [];
        if ($categories !== null) {
            $data = CategoryCollectionResource::make($categories);
        }

        return $this->success($data);
    }

    /**
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function updateCategory(UpdateCategoryRequest $request): Response
    {
        $categoryId = $request->get('categoryId');
        $name = $request->get('name');

        $category = $this->categoryService->updateCategory($categoryId, $name);

        $data = CategoryResource::make($category);

        return $this->success($data);
    }

    /**
     * @param DeleteCategoryRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function deleteCategory(DeleteCategoryRequest $request): Response
    {
        $categoryId = $request->get('categoryId');
        $this->categoryService->deleteCategory($categoryId);

        return $this->success([]);
    }
}
