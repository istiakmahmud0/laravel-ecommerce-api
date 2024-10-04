<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Get all product
     */
    public function getAllProduct(array $relationshipNames, string $collectionNames): Collection;

    /**
     * Create new product
     */
    public function createNewProduct(array $productDetails): Product;
}
