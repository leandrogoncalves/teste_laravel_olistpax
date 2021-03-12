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
     * @OA\Info(
     *      version="1.0.0",
     *      title="Olistpax API Test",
     *      description="Api to manage products",
     *      @OA\Contact(
     *          email="contato.leandrogoncalves@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url="http://localhost:8081",
     *      description="API Server"
     * )

     *
     * @OA\Tag(
     *     name="Products",
     *     description="API Endpoints of Products"
     * )
     */

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
     * @OA\Get(
     *      path="/api/v1/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductCollection"),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
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
     * @OA\Post(
     *      path="/api/v1/products",
     *      operationId="storeProduct",
     *      tags={"Products"},
     *      summary="Store new product",
     *      description="Returns product data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(ProductRequest $request)
    {
        try {
            return new ProductResource(
                $this->productRepository->store($request->all())
            );
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Ocorreu um erro interno no servidor'
            ], 500);
        }
    }


    /**
     * @OA\Get(
     *      path="/api/v1/products/{id}",
     *      operationId="getProductById",
     *      tags={"Products"},
     *      summary="Get product information",
     *      description="Returns product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
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
     * @OA\Put(
     *      path="/api/v1/products/{id}",
     *      operationId="updateProducts",
     *      tags={"Products"},
     *      summary="Update existing product",
     *      description="Returns updated product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Products id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
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
     * @OA\Delete(
     *      path="/api/v1/products/{id}",
     *      operationId="deleteProduct",
     *      tags={"Products"},
     *      summary="Delete existing product",
     *      description="Deletes a record and returns content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
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
