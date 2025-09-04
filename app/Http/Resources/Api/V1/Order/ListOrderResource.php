<?php

namespace App\Http\Resources\Api\V1\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'sender_name' => $this->resource->sender_name,
            'sender_mobile'=> $this->resource->sender_mobile,
            'receiver_name' => $this->resource->receiver_name,
            'receiver_mobile'=> $this->resource->receiver_mobile,
            'barcode' => $this->resource->barcode,
            'status' => $this->resource->status->value,
            "created_at" => $this->date_convert($this->resource->created_at,'Y/m/d H:i:s'),
        ];
    }
}
