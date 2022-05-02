<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\StoreLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
use App\Http\Resources\Language\LanguageResource;
use App\Models\Language;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Language::class, 'language');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['languages' => LanguageResource::collection(Language::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLanguageRequest $request
     * @return JsonResponse
     */
    public function store(StoreLanguageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $language = new Language();
        $language->name = $validated['name'];
        $language->image_id = $validated['image'];
        $language->code = $validated['code'];
        $language->english_name = $validated['english_name'];
        $language->save();

        return $this->Success('Language has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Language $language
     * @return JsonResponse
     */
    public function show(Language $language): JsonResponse
    {
        return $this->Data(['language' => new LanguageResource($language)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLanguageRequest $request
     * @param Language $language
     * @return JsonResponse
     */
    public function update(UpdateLanguageRequest $request, Language $language): JsonResponse
    {
        $validated = $request->validated();

        $language->name = $validated['name'];
        $language->image_id = $validated['image'];
        $language->code = $validated['code'];
        $language->english_name = $validated['english_name'];
        $language->save();

        return $this->Success('Language has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Language $language
     * @return JsonResponse
     */
    public function destroy(Language $language): JsonResponse
    {
        $language->delete();
        return $this->Success('Language has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     */
    public function get_trashed(): JsonResponse
    {
        return $this->Data(['languages' => LanguageResource::collection(Language::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Language $trashed_Language
     * @return JsonResponse
     */
    public function restore($trashed_Language): JsonResponse
    {
        $trashed_Language = Language::onlyTrashed()->findOrFail($trashed_Language);
        $trashed_Language->restore();
        return $this->Success('Language has been Restored Successfully');
    }

    public function get_model_data($model): JsonResponse
    {
        $model = app("App\Models\\$model");
        $model = new $model();
        $multi_language_columns = $model->getMultiLanguageColumns();
        return $this->Data([
            'multi_language_columns' => $multi_language_columns,
            'languages' => Language::select('name', 'code', 'english_name', 'id')->get()
        ]);
    }
}
