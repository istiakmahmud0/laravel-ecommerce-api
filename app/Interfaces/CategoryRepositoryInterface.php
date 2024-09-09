<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{

    /**
     * Find all categories
     */
    // public function getAllCategories(): Collection;

    /**
     * Create categories
     */

    public function createCategory(array $categoryDetails): Category;
}
