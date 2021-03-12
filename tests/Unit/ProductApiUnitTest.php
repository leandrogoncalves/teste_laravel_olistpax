<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductApiUnitTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        DB::beginTransaction();
    }

    /**
     * Test of api method index from product repository
     */
    public function testGetAllProductsByRepository()
    {
        $repository = app(ProductRepository::class);

        $collection = $repository->findAll();

        $this->assertInstanceOf(Arrayable::class, $collection);
    }

    /**
     * Test of api method index from product repository
     */
    public function testStoreProductsByRepository()
    {
        $repository = app(ProductRepository::class);

        $product = $repository->store([
            "name" => "Sabote sem marca"
        ]);

        $this->assertInstanceOf(Product::class, $product);

        DB::rollBack();
    }

    /**
     * Test of api method index from product repository
     */
    public function testProductsGetByIdRepository()
    {
        $repository = app(ProductRepository::class);

        $product = $repository->findById(1);

        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * Test of api method index from product repository
     */
    public function testUpdateProductsByRepository()
    {
        $repository = app(ProductRepository::class);

        $product = $repository->store([
            "name" => "Sabote sem marca",
            "quantity" => 5
        ], 1);

        $this->assertInstanceOf(Product::class, $product);

        DB::rollBack();
    }

    /**
     * Test of api method index from product repository
     */
    public function testDeleteProductsByIdRepository()
    {
        $repository = app(ProductRepository::class);

        $isRemoved = $repository->delete(1);

        $this->assertTrue($isRemoved);

        DB::rollBack();
    }
}
