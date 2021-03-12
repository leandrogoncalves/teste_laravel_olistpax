<?php


namespace App\Repositories\Contracts;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package App\Repositories\Contracts
 */
interface RepositoryInterface
{
    /**
     * @return Arrayable
     */
    public function findAll():Arrayable;

    /**
     * @return mixed
     */
    public function findAllPaginated();

    /**
     * @param $id
     * @return Model
     */
    public function findById($id):Model;

    /**
     * @param array $data
     * @param null $id
     * @return Model
     */
    public function store(array $data, $id = null):Model;

    /**
     * @param $id
     * @return bool
     */
    public function delete($id):bool;

}
