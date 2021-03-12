<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->productRepository = $repository;
    }

    /**
     * @return ProductCollection|JsonResponse
     */
    public function index()
    {
        try {
            return new ProductCollection(
                $this->productRepository->findAllPaginated()
            );
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocorreu um erro interno no servidor'
            ], 500);
        }
    }

    /**
     * @param ProductRequest $request
     * @return ProductResource|JsonResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            return new ProductResource(
                $this->productRepository->store($request->validated())
            );
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocorreu um erro interno no servidor'
            ], 500);
        }
    }

    /**
     * @param Product $product
     * @return ProductResource|JsonResponse
     */
    public function show(Product $product)
    {
        try {
            return new ProductResource($product);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocorreu um erro interno no servidor'
            ], 500);
        }
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return ProductResource|JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            return new ProductResource(
                $this->productRepository->store($request->all(), $product->id)
            );
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocorreu um erro interno no servidor'
            ], 500);
        }
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            return new JsonResponse([
                'removed' => $this->productRepository->delete($product->id)
            ]);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocorreu um erro interno no servidor'
            ], 500);
        }
    }
}
