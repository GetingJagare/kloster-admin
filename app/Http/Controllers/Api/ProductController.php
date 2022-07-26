<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        $fields = $request->all();
        $categoryCount = count($fields['categories']);
        if ($categoryCount < 2 || $categoryCount > 10) {
            return response()->json([
                'success' => 0,
                'message' => "Product must have from 2 to 10 categories",
            ]);
        }

        /**
         * @var Product $product
         */
        $product = Product::create($fields);
        $product->categories()->attach($fields['categories']);

        return response()->json([
            'success' => 1,
            'message' => "Successfully saved",
            'product' => $product,
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => Product::with('categories')->where(['id' => $product->id])->first(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * @param StoreProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $fields = $request->all();
        $categoryCount = count($fields['categories']);
        if ($categoryCount < 2 || $categoryCount > 10) {
            return response()->json([
                'message' => "Product must have from 2 to 10 categories",
                'success' => 0,
            ]);
        }

        /**
         * @var Product $product
         */
        $product->update($fields);
        /**
         * @var Category $cat
         */
        foreach ($product->categories()->get() as $cat) {
            $product->categories()->detach($cat->id);
        }
        $product->categories()->attach($fields['categories']);

        return response()->json([
            'message' => "Product updated successfully!",
            'product' => $product,
            'success' => 1,
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'success' => 1,
            'message' => "Product deleted successfully!",
        ]);
    }
}
