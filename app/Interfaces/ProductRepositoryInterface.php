<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Get all product
     */
    public function getAllProduct(array $relationshipNames): Collection;

    /**
     * Create new product
     */
    public function createNewProduct(array $productDetails): Product;

    /**
     * Get single product by it's slug
     */
    public function getSingleProductBySlug(string $slug, array $relationshipNames): Product;
}
