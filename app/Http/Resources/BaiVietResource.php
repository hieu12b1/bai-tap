<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BaiVietResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'hinh_anh' => $this->hinh_anh ? Storage::url($this->hinh_anh) : null,
            'tieu_de' => $this->tieu_de,
            'noi_dung' => $this->noi_dung,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
