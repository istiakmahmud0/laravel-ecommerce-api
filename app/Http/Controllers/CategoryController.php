<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Category controller constructor
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getAllCategories('media', 'category_images');
        return Response::sendResponse('All categories', ['categories' => CategoryResource::collection($categories)], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->createCategory($request->validated());
        $categoryImage = null;
        if ($request->hasFile('category_img')) {
            $media = $category->addMediaFromRequest('category_img')->toMediaCollection('category_images');
            $categoryImage = $media->getUrl();
        }
        return Response::sendResponse('Category created successfully', ['category' => $category, 'category_img' => $categoryImage], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
