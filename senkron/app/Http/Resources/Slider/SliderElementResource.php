<?php

namespace App\Http\Resources\Slider;



use Illuminate\Http\Resources\Json\JsonResource;

class SliderElementResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->withTranslations([
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'content_position' => $this->content_position,
            'image' => $this->image?->id,
            'image_url' => $this->image?->url,
            'background' => $this->background?->id,
            'background_url' => $this->background?->url,
        ]);
    }
}
