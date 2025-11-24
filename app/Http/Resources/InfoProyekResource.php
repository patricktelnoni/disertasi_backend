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
    public $status;
    public $message;
    public $resource;
    public $total;


    public function __construct($status, $message, $resource, $total = []){
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
        $this->total  = $total;
    }

    public function toArray(Request $request): array
    {
        if($this->total > 0 ){
            return [
                'success'   => $this->status,
                'message'   => $this->message,
                'total'     => $this->total,
                'data'      => $this->resource
  
            ];
        }
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource
        ];
    }
}
