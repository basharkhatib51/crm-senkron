<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Arr;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['products' => ProductResource::collection(Product::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $product = new Product();
        $product->name = $validated['name'];
        $product->price = 0;
        if (isset($validated['price']))
            $product->price = $validated['price'];
        $product->description = $validated['description'];
        if (isset($validated['image_id'])) {
            $product->image_id = $validated['image_id'];
        }
        if (isset($validated['category'])) {
            $product->category_id = $validated['category'];
        }
        $product->translate_columns($request);
        $product->save();
        if (isset($validated['images'])) {
            $product->product_images()->sync(
                Arr::pluck($validated['images'], 'id')
            );
        }
        if (isset($validated['tags'])) {
            $product->tags()->sync(
                $validated['tags']
            );
        }
        if (isset($validated['details'])) {
            foreach ($validated['details'] as $detail) {
                $product_details = new ProductDetail();
                $product_details->key = $detail['key'];
                $product_details->value = $detail['value'];
                $product_details->product_id = $product->id;
                $product_details->translate_columns($detail);
                $product_details->save();
            }
        }
        return $this->Success('Product has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return $this->Data(['product' => new ProductResource($product)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $validated = $request->validated();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        if (isset($validated['image_id'])) {
            $product->image_id = $validated['image_id'];
        }
        if (isset($validated['category'])) {
            $product->category_id = $validated['category'];
        }
        $product->translate_columns($request);
        $product->save();
        if (isset($validated['images'])) {
            $product->product_images()->sync(
                Arr::pluck($validated['images'], 'id')
            );
        }
        if (isset($validated['tags'])) {
            $product->tags()->sync(
                $validated['tags']
            );
        }
        $product->product_details()->forceDelete();
        if (isset($validated['details'])) {
            foreach ($validated['details'] as $detail) {
                $product_details = new ProductDetail();
                $product_details->key = $detail['key'];
                $product_details->value = $detail['value'];
                $product_details->product_id = $product->id;
                $product_details->translate_columns($detail);
                $product_details->save();
            }
        }
        return $this->Success('Product has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->Success('Product has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Product::Class);
        return $this->Data(['products' => ProductResource::collection(Product::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Product $trashed_product
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_product): JsonResponse
    {
        $this->authorize('restore', Product::Class);
        $trashed_tag = Product::onlyTrashed()->findOrFail($trashed_product);
        $trashed_tag->restore();
        return $this->Success('Product has been Restored Successfully');
    }
}
