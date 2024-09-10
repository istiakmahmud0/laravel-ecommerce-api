<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

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
     * Find all categories
     */
    public function getAllCategories(?string $relationNames, ?string $collectionNames): Collection
    {
        return $this->model::whereHas($relationNames, function ($query) use ($collectionNames) {
            $query->where('collection_name', $collectionNames);
        })
            ->with($relationNames)
            ->get();
    }

    /**
     * Create categories
     */
    public function createCategory(array $categoryDetails): Category
    {
        return $this->model->create($categoryDetails);
    }

    /**
     * Get category by it's id
     */
    public function getCategoryById(string $id, ?array $relationNames = null): Category
    {
        $category = $this->model->query();
        return $category->when($relationNames, function ($query) use ($relationNames) {
            $query->with($relationNames);
        })->findOrFail($id);
    }
}
