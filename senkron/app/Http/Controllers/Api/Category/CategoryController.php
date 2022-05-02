<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['categories' => CategoryResource::collection(Category::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $category = new Category();
        $category->name = $validated['name'];
        $category->image_id = $validated['image'];
        $category->category_id = $validated['parent_category'];
        $category->translate_columns($request);
        $category->save();
        return $this->Success('Category has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return $this->Data(['category' => new CategoryResource($category)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $validated = $request->validated();
        $category->name = $validated['name'];
        $category->image_id = $validated['image'];
        $category->category_id = $validated['parent_category'];
        $category->translate_columns($request);
        $category->save();

        return $this->Success('Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $children_categories = $category->children_categories();
        $children_categories->update(['category_id' => null]);;
        $category->delete();
        return $this->Success('Category has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Category::Class);
        return $this->Data(['categories' => CategoryResource::collection(Category::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Category $trashed_Category
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_Category): JsonResponse
    {
        $this->authorize('restore', Category::Class);
        $trashed_Category = Category::onlyTrashed()->findOrFail($trashed_Category);
        $trashed_Category->restore();
        return $this->Success('Category has been Restored Successfully');
    }
}
