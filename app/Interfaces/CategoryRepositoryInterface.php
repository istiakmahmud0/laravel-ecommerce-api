<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{

    /**
     * Find all categories
     */
    public function getAllCategories(?string $relationNames, ?string $collectionNames): Collection;

    /**
     * Create categories
     */
    public function createCategory(array $categoryDetails): Category;

    /**
     * Get category by it's id
     */
    public function getCategoryById(string $id, ?array $relationNames = null): Category;

    /**
     * Update category
     */
    public function updateCategory(object $category, array $newDetails): bool;

    /**
     * Delete category
     */
    public function deleteCategory(object $category): bool;
}
