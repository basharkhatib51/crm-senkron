<?php

namespace App\Http\Resources\Section;



use Illuminate\Http\Resources\Json\JsonResource;

class ElementResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->withTranslations([
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'title' => $this->title,
            'image_id' => $this->image?->id,
            'image_url' => $this->image?->url,
            'section_id' => $this->section_id,
            'pack' => $this->pack,
            'icon' => $this->icon,
            'page_id' => $this->page_id,
            'url' => $this->url,
            'description' => $this->description,
        ]);

    }
}
