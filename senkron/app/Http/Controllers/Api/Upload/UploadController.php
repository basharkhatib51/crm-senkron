<?php

namespace App\Http\Controllers\Api\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\UploadImagesRequest;
use App\Http\Requests\Upload\UploadImageRequest;
use App\Models\Upload;
use App\Traits\UploadFile;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
class UploadController extends Controller
{
    use UploadFile;

    /**
     * upload image.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function upload_image(UploadImageRequest $request): JsonResponse
    {

        $uploadedFile = $request->file('file');
        $extension = $uploadedFile->getClientOriginalExtension();
        $folderName = 'uploads/image/' . Carbon::now()->format('Y-m-d') . '/' . time() . uniqid();
        $filename = $uploadedFile->getClientOriginalName();
        $Media = new Upload();
        $Media->url = $folderName . '/' . $filename;
        $Media->real_path = $uploadedFile->getRealPath();
        $Media->size = $uploadedFile->getSize();
        $Media->mime_type = $uploadedFile->getMimeType();
        $Media->type = 'Image';
        $Media->generated_name = $filename;
        $Media->original_name = explode(".", $uploadedFile->getClientOriginalName())[0];
        $Media->extension = $extension;
        $Media->save();
        Storage::disk('public')->putFileAs(
            $folderName,
            $uploadedFile,
            $filename
        );
        $new_url = substr($Media->url, 0, -strlen($Media->extension)-1) . '100x100.' . $Media->extension;
        if (File::exists($Media->url) && !File::exists($new_url)) {
            $img = Image::make($Media->url);
            $img->resize(100, 100);
            $img->save($new_url);
        }
        return $this->Data(['image' => $Media]);
//        http://localhost:8000/uploads/image/2021-12-30/164086987261cdaff0d8d56/WhatsApp%20Image%202021-12-30%20at%203.43.25%20PM%20(2).jpeg

    }

    public function upload_images(UploadImagesRequest $request): JsonResponse
    {
        $Medias = [];
        $ids = [];
        foreach ($request->all() as $file) {
            $uploadedFiles = $file;
            $folderName = 'uploads/image/' . Carbon::now()->format('Y-m-d');
            $extension = $uploadedFiles->getClientOriginalExtension();
            $filename = time() . uniqid() . '.' . $extension;
            $Media = new Upload();
            $Media->url = $folderName . '/' . $filename;
            $Media->real_path = $uploadedFiles->getRealPath();
            $Media->size = $uploadedFiles->getSize();
            $Media->mime_type = $uploadedFiles->getMimeType();
            $Media->type = 'Image';
            $Media->generated_name = $filename;
            $Media->original_name = $uploadedFiles->getClientOriginalName();
            $Media->extension = $extension;
            $Media->save();
            Storage::disk('public')->putFileAs(
                $folderName,
                $uploadedFiles,
                $filename
            );
            $new_url = substr($Media->url, 0, -strlen($Media->extension)-1) . '100x100.' . $Media->extension;
            if (File::exists($Media->url) && !File::exists($new_url)) {
                $img = Image::make($Media->url);
                $img->resize(100, 100);
                $img->save($new_url);
            }
            $Medias[] = $Media;
            $ids[] = $Media->id;
        }

        return $this->Data(['images' => $Medias, 'ids' => $ids]);
    }


    public function image(Upload $upload): JsonResponse
    {
        return $this->Data(['image' => $upload]);
    }

    public function images()
    {
//        return request()->currentPage;
//        return request()->perPage;
        $images=Upload::orderBy('id', 'DESC')->paginate(request()->perPage, '*', 'page', request()->currentPage);
//        dd($images);
//        ->paginate(15)
        return $this->Data(['images' => $images]);
    }

    public function description(Upload $upload, Request $request): JsonResponse
    {

        $upload->name = $request->name;
        $upload->description = $request->description;
        $upload->save();

        return $this->Success('Image has been add successfully');
    }
}
