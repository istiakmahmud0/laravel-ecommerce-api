<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Product repository constructor
     */
    public function __construct(protected Product $model)
    {
        $this->model = $model;
    }

    /**
     * Get all product
     */
    public function getAllProduct(array $relationshipNames = []): Collection
    {
        return $this->model::with($relationshipNames)->get();
        // return $this->model::when($relationshipNames, function ($query) use ($relationshipNames) {
        //     $query->with($relationshipNames);
        // })->get();
    }

    public function createNewProduct(array $productDetails): Product
    {
        return $this->model->create($productDetails);
    }

    /**
     * Get single product by it's slug
     */
    public function getSingleProductBySlug(string $slug, array $relationshipNames = null): Product
    {
        $product = $this->model->query();
        return $product->with($relationshipNames)->where('slug', $slug)->firstOrFail();
    }

    /**
     * Get single product by it's ID
     */
    public function getSingleProductByID(string $id, ?array $relationshipNames = []): Product
    {
        $product = $this->model->query();
        return $product->with($relationshipNames)->findOrFail($id);
    }

    /**
     * Update Product
     */
    public function updateProduct(object $product, array $newDetails): bool
    {
        return $product->update($newDetails);
    }

    /**
     * Update Product
     */
    public function deleteProduct(object $product): bool
    {
        return $product->delete();
    }
}
