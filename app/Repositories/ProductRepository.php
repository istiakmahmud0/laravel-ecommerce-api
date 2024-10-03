<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Product repository constructor
     */
    public function __construct(protected Product $model)
    {
        $this->model = $model;
    }

    public function createNewProduct(array $productDetails): Product
    {
        return $this->model->create($productDetails);
    }
}
