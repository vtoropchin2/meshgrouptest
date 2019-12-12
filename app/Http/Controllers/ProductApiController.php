<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddProductPhotoRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\GetProductByCategoryRequest;
use App\Http\Requests\MoveProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollectionResource;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Response;

/**
 * Class ProductApiController
 * @package App\Http\Controllers
 */
class ProductApiController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * ProductApiController constructor.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function createProduct(CreateProductRequest $request): Response
    {
        $product = $this->productService->createProduct(
            $request->get('categoryId'),
            $request->get('name'),
            $request->get('description')
        );

        $data = ProductResource::make($product);

        return $this->success($data);
    }

    /**
     * @param GetProductByCategoryRequest $request
     *
     * @return Response
     */
    public function getProductsByCategoryId(GetProductByCategoryRequest $request): Response
    {
        $product = $this->productService->getProductsByCategoryId($request->get('categoryId'));

        $data = ProductCollectionResource::make($product);

        return $this->success($data);
    }

    /**
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function updateProduct(UpdateProductRequest $request): Response
    {
        $product = $this->productService->updateProduct(
            $request->get('productId'),
            $request->get('name'),
            $request->get('description')
        );

        $data = ProductResource::make($product);

        return $this->success($data);
    }

    /**
     * @param DeleteProductRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function deleteProduct(DeleteProductRequest $request): Response
    {
        $this->productService->deleteProduct($request->get('productId'));

        return $this->success([]);
    }

    /**
     * @param MoveProductRequest $request
     *
     * @return Response
     */
    public function moveProduct(MoveProductRequest $request): Response
    {
        $this->productService->moveProduct(
            $request->get('productId'),
            $request->get('categoryId')
        );

        return $this->success([]);
    }

    /**
     * @param AddProductPhotoRequest $request
     *
     * @return Response
     */
    public function addProductPhoto(AddProductPhotoRequest $request): Response
    {
        $productId = $request->get('productId');
        $image = $request->file('image');

        $product = $this->productService->addProductPhoto($productId, $image);

        $data = ProductResource::make($product);

        return $this->success($data);
    }
}
