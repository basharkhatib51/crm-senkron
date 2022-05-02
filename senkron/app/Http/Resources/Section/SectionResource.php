<?php

namespace App\Http\Resources\Section;



use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->withTranslations([
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'elements' => ElementResource::collection($this->elements),
            'name' => $this->name,
            'elements_col' => $this->elements_col,
            'image' => $this->image,
            'description' => $this->description,
            'icon' => $this->icon,
            'link' => $this->link,
        ]);

    }
}
