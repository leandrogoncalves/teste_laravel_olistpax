<?php


namespace App\Repositories;


use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    private $model;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @return Arrayable
     */
    public function findAll():Arrayable
    {
        return $this->model->get();
    }

    /**
     * @return mixed
     */
    public function findAllPaginated()
    {
        return $this->model->paginate();
    }

    /**
     * @param $id
     * @return Model
     */
    public function findById($id):Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @param null $id
     * @return Model
     */
    public function store(array $data, $id = null):Model
    {
        $model = $this->model;
        if($id){
            $model = $this->findById($id);
        }
        $model->fill($data)->save();
        return $model;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id):bool
    {
        $model = $this->findById($id);
        return $model->delete();
    }

}
