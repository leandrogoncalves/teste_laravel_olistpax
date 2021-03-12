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

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->productRepository = $repository;
    }

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
