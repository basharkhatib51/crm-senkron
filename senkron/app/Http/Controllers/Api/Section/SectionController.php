<?php

namespace App\Http\Controllers\Api\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\UpdateSectionRequest;
use App\Http\Resources\Section\SectionResource;
use App\Models\Element;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Section::class, 'section');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['sections' => SectionResource::collection(Section::all())]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param Section $category
     * @return JsonResponse
     */
    public function update(UpdateSectionRequest $request, Section $section): JsonResponse
    {
        $validated = $request->validated();
        $section->name = $validated['name'];
        $section->translate_columns($request);
        $section->save();
        $section->elements()->forceDelete();
        foreach ($validated['elements'] as $value) {
            $element = new Element();
            $element->section_id = $section->id;
            if (isset($value['title']))
                if ($value['title'])
                    $element->title = $value['title'];
            if (isset($value['image_id']))
                if ($value['image_id'])
                    $element->image_id = $value['image_id'];
            if (isset($value['url']))
                if ($value['url'])
                    $element->url = $value['url'];
            if (isset($value['page_id']))
                if ($value['page_id'])
                    $element->page_id = $value['page_id'];

            if (isset($value['pack']))
                if ($value['pack'])
                    $element->pack = $value['pack'];
            if (isset($value['icon']))
                if ($value['icon'])
                    $element->icon = $value['icon'];
            if (isset($value['description']))
                if ($value['description'])
                    $element->description = $value['description'];
            $element->translate_columns($value);
            $element->save();
        }
        return $this->Success('Sections has been updated successfully');
    }


}
