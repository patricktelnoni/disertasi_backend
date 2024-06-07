<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SekolahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_sekolah' => $this->nama_sekolah,  
            'alamat_sekolah' => $this->alamat_sekolah,
            'no_telp' => $this->no_telp
        ];
    }
}
