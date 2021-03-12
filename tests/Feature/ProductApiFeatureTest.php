<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductApiFeatureTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        DB::beginTransaction();
    }

    /**
     * Test of api method index from product controller
     */
    public function testGetAllProductsByApi()
    {
        $response = $this->get(route('product.index'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'quantity',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);

    }

    /**
     * Test of api method store from product controller
     */
    public function testStoreProductsByApi()
    {
        $response = $this->post(route('product.store'),[
            "name" => "Sabote sem marca ".rand(1,1000)
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' =>
                    [
                        'id',
                        'name',
                        'created_at',
                        'updated_at',
                    ]
            ]);

        DB::rollBack();
    }
}
