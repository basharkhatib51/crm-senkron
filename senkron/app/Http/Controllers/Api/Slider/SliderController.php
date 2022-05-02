<?php

namespace App\Http\Controllers\Api\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Http\Resources\Slider\SliderResource;
use App\Models\Slider;
use App\Models\SliderElement;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Slider::class, 'slider');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['sliders' => SliderResource::collection(Slider::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSliderRequest $request
     * @return JsonResponse
     */
    public function store(StoreSliderRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $slider = new Slider();
        $slider->name = $validated['name'];
        $slider->translate_columns($request);
        $slider->save();
        if (isset($validated['elements'])) {
            foreach ($validated['elements'] as $element) {
                $slider_element = new SliderElement();
                $slider_element->title = $element['title'];
                $slider_element->content = $element['content'];
                $slider_element->content_position = $element['content_position'];
                $slider_element->image_id = $element['image'];
                $slider_element->background_id = $element['background'];
                $slider_element->slider_id = $slider->id;
                $slider_element->translate_columns($element);
                $slider_element->save();
            }
        }

        return $this->Success('Slider has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return JsonResponse
     */
    public function show(Slider $slider): JsonResponse
    {
        return $this->Data(['slider' => new SliderResource($slider)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSliderRequest $request
     * @param Slider $slider
     * @return JsonResponse
     */
    public function update(UpdateSliderRequest $request, Slider $slider): JsonResponse
    {
        $validated = $request->validated();
        $slider->slider_elements()->forceDelete();
        $slider->name = $validated['name'];
        $slider->translate_columns($request);
        $slider->save();
        $slider->slider_elements()->forceDelete();
        if (isset($validated['elements'])) {
            foreach ($validated['elements'] as $element) {
                $slider_element = new SliderElement();
                $slider_element->title = $element['title'];
                $slider_element->content = $element['content'];
                $slider_element->content_position = $element['content_position'];
                $slider_element->image_id = $element['image'];
                $slider_element->background_id = $element['background'];
                $slider_element->slider_id = $slider->id;
                $slider_element->translate_columns($element);
                $slider_element->save();
            }
        }

        return $this->Success('Slider has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return JsonResponse
     */
    public function destroy(Slider $slider): JsonResponse
    {
        $slider->delete();
        return $this->Success('Slider has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Slider::Class);
        return $this->Data(['sliders' => SliderResource::collection(Slider::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Slider $trashed_slider
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_slider): JsonResponse
    {
        $this->authorize('restore', Slider::Class);
        $trashed_slider = Slider::onlyTrashed()->findOrFail($trashed_slider);
        $trashed_slider->restore();
        return $this->Success('Slider has been Restored Successfully');
    }
}
