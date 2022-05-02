<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Resources\Page\PageResource;
use App\Models\Page;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['pages' => PageResource::collection(Page::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePageRequest $request
     * @return JsonResponse
     */
    public function store(StorePageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $page = new Page();
        $page->title = $validated['title'];
        $page->image = $validated['image'];
        $page->background = $validated['background'];
        $page->content = $validated['content'];
        $page->excerpt = $validated['excerpt'];
        $page->layout = $validated['layout'];
        $page->type = $validated['type'];
        $page->status = $validated['status'];
        if(isset($validated['slider_id']))
        $page->slider_id = $validated['slider_id'];
        if(isset($validated['category']))
        $page->service_category_id = $validated['category'];
        $page->translate_columns($request);
        $page->save();
        if (isset($validated['tags'])) {
            $page->tags()->attach($validated['tags']);
        }

        return $this->Success('Page has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function show(Page $page): JsonResponse
    {
        return $this->Data(['page' => new PageResource($page)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePageRequest $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(UpdatePageRequest $request, Page $page): JsonResponse
    {
        $validated = $request->validated();
        $page->title = $validated['title'];
        $page->image = $validated['image'];
        $page->background = $validated['background'];
        $page->content = $validated['content'];
        $page->excerpt = $validated['excerpt'];
        $page->layout = $validated['layout'];
        $page->status = $validated['status'];
        $page->type = $validated['type'];
        $page->slider_id = $validated['slider_id'];
        $page->service_category_id = $validated['category'];
        $page->translate_columns($request);
        $page->save();
        if (isset($validated['tags'])) {
            $page->tags()->sync($validated['tags']);
        }

        return $this->Success('Page has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function destroy(Page $page): JsonResponse
    {
        $page->tags()->detach();
        $page->menus()->delete();
        $page->delete();
        return $this->Success('Page has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Page::Class);
        return $this->Data(['pages' => PageResource::collection(Page::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Page $trashed_page
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_page): JsonResponse
    {
        $this->authorize('restore', Page::Class);
        $trashed_page->restore();
        return $this->Success('Page has been Restored Successfully');
    }
}
