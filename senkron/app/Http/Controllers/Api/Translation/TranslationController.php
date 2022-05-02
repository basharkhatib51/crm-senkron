<?php

namespace App\Http\Controllers\Api\Translation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Translation\UpdateTranslationRequest;
use App\Http\Resources\Translation\TranslationResource;
use App\Models\Element;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;

class TranslationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Translation::class, 'translation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['translations' => TranslationResource::collection(Translation::all())]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTranslationRequest $request
     * @param Translation $translation
     * @return JsonResponse
     */
    public function update(UpdateTranslationRequest $request, Translation $translation): JsonResponse
    {
        $validated = $request->validated();
//        $translation->content = $validated['content'];
        $translation->translate_columns($request);
        $translation->save();
        return $this->Success('Translation has been updated successfully');
    }


}
