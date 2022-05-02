<?php

namespace App\Http\Resources\Product;

//{{ use }}

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->withTranslations([
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
        ]);
    }
}
