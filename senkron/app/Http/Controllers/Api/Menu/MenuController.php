<?php

namespace App\Http\Controllers\Api\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Resources\Menu\MenuResource;
use App\Models\Menu;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Menu::class, 'menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['menus' => MenuResource::collection(Menu::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenuRequest $request
     * @return JsonResponse
     */
    public function store(StoreMenuRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $menu = new Menu();
        $menu->name = $validated['name'];
        $menu->type = $validated['type'];
        $menu->url = $validated['url'];
        $menu->menu_id = $validated['parent_menu'];
        $menu->translate_columns($request);
        $menu->save();
        return $this->Success('Menu has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function show(Menu $menu): JsonResponse
    {
        return $this->Data(['menu' => new MenuResource($menu)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMenuRequest $request
     * @param Menu $menu
     * @return JsonResponse
     */
    public function update(UpdateMenuRequest $request, Menu $menu): JsonResponse
    {
        $validated = $request->validated();
        $menu->name = $validated['name'];
        $menu->type = $validated['type'];
        $menu->url = $validated['url'];
        $menu->menu_id = $validated['menu_id'];
        $menu->translate_columns($request);
        $menu->save();

        return $this->Success('Menu has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function destroy(Menu $menu): JsonResponse
    {
        $children_menus = $menu->children_menus();
        $children_menus->update(['menu_id' => null]);;
        $menu->delete();
        return $this->Success('Menu has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Menu::Class);
        return $this->Data(['menus' => MenuResource::collection(Menu::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Menu $trashed_Menu
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_Menu): JsonResponse
    {
        $this->authorize('restore', Menu::Class);
        $trashed_Menu = Menu::onlyTrashed()->findOrFail($trashed_Menu);
        $trashed_Menu->restore();
        return $this->Success('Menu has been Restored Successfully');
    }
}
