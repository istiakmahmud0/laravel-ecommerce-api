<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * Category repository construct
     */

    public function __construct(protected Category $model)
    {
        $this->model = $model;
    }

    /**
     * Create categories
     */

    public function createCategory(array $categoryDetails): Category
    {
        return $this->model->create($categoryDetails);
    }
}
