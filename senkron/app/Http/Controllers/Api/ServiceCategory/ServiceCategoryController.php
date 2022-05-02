<?php

namespace App\Http\Controllers\Api\ServiceCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategory\StoreServiceCategoryRequest;
use App\Http\Requests\ServiceCategory\UpdateServiceCategoryRequest;
use App\Http\Resources\ServiceCategory\ServiceCategoryResource;
use App\Models\ServiceCategory;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ServiceCategory::class, 'service_category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['service_categories' => ServiceCategoryResource::collection(ServiceCategory::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServiceCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreServiceCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $service_category = new ServiceCategory();
        $service_category->name = $validated['name'];
        $service_category->service_category_id = $validated['parent_category'];
        $service_category->translate_columns($request);
        $service_category->save();
        return $this->Success('Service Category has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceCategory $serviceCategory
     * @return JsonResponse
     */
    public function show(ServiceCategory $serviceCategory): JsonResponse
    {
        return $this->Data(['service_category' => new ServiceCategoryResource($serviceCategory)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateServiceCategoryRequest $request
     * @param ServiceCategory $serviceCategory
     * @return JsonResponse
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory): JsonResponse
    {
        $validated = $request->validated();
        $serviceCategory->name = $validated['name'];
        $serviceCategory->service_category_id = $validated['parent_service_category_id'];
        $serviceCategory->translate_columns($request);
        $serviceCategory->save();

        return $this->Success('Service Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceCategory $serviceCategory
     * @return JsonResponse
     */
    public function destroy(ServiceCategory $serviceCategory): JsonResponse
    {
        $children_categories = $serviceCategory->children_service_categories();
        $children_categories->update(['service_category_id' => null]);;
        $serviceCategory->delete();
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
        $this->authorize('get_trashed', ServiceCategory::Class);
        return $this->Data(['service_categories' => ServiceCategoryResource::collection(ServiceCategory::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param ServiceCategory $trashed_serviceCategory
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_serviceCategory): JsonResponse
    {
        $this->authorize('restore', ServiceCategory::Class);
        $trashed_serviceCategory = ServiceCategory::onlyTrashed()->findOrFail($trashed_serviceCategory);
        $trashed_serviceCategory->restore();
        return $this->Success('Service Category has been Restored Successfully');
    }
}
