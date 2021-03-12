<?php


namespace App\Virtual\collections;


/**
 * @OA\Schema(
 *     title="ProductCollection",
 *     description="Product collection",
 *     @OA\Xml(
 *         name="ProductCollection"
 *     )
 * )
 */
class ProductCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Product[]
     */
    private $data;
}
