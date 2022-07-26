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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->all();


        if ($filters) {
            $products = Product::all()->toQuery();

            if ($filters['name']) {
                $products->where('name', 'LIKE', "%{$filters['name']}%");
            }

            if ($filters['category_id']) {
                $products->whereRelation('categories', ['category_id' => $filters['category_id']]);
            }

            if ($filters['category_name']) {
                $products->whereRelation('categories', 'name', 'LIKE', "%{$filters['category_name']}%");
            }

            if ((int)$filters['price_from']) {
                $products->where('price', '>=', $filters['price_from']);
            }

            if ((int)$filters['price_to']) {
                $products->where('price', '<=', $filters['price_to']);
            }

            if (($filters['is_published'] == 'true')) {
                $products->where('is_published', '=', true);
            }

            if ($filters['not_deleted'] == 'true') {
                $products->where('is_deleted', '=', false);
            }

            $products = $products->get();
        } else {
            $products = Product::all();
        }

        return response()->json([
            'products' => $products,
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
