<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Product controller constructor
     */
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getAllProduct(['media', 'category']);
        return Response::sendResponse('All Products', ['products' => ProductResource::collection($products)], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->productRepository->createNewProduct($request->validated());
        $productImage = null;
        if ($request->hasFile('product_img')) {
            $media = $product->addMediaFromRequest('product_img')->toMediaCollection('product_images');
            $productImage = $media->getUrl();
        }
        return Response::sendResponse('Product has been created', ['product' => $product, 'productImage' => $productImage], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): JsonResponse
    {

        $product = $this->productRepository->getSingleProductBySlug($slug, ['media', 'category']);
        // dd($product);
        return Response::sendResponse('Single Product', ['product' => new ProductResource($product)], 200);
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
