<?php


namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Product request",
 *      description="Store Product request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class ProductRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new product",
     *      example="A nice product"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="quantity",
     *      description="Description of the new product",
     *      example="10"
     * )
     *
     * @var string
     */
    public $quantity;
}
