<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoProyekResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'nomor_kontrak'     => $this->nomor_kontrak,
            'nama_paket'        => $this->nama_paket,
            'nama_satker'       => $this->nama_satker,
            'nama_ppk'          => $this->nama_ppk,
            'nilai_kontrak'     => $this->nilai_kontrak,
            'lokasi_pekerjaan'  => $this->lokasi_pekerjaan,
            'masa_pelaksanaan'  => $this->masa_pelaksanaan,
            'tanggal_pho'       => $this->tanggal_pho,
            'tanggal_kontrak'   => $this->tanggal_kontrak,
            'image'             => $this->image,
        ];
    }
}
