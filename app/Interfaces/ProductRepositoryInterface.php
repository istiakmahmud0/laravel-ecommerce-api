<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    /**
     * Create new product
     */
    public function createNewProduct(array $productDetails): Product;
}
