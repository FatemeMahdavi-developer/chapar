<?php

namespace App\Http\Resources\Api\V1\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sender_name' => $this->resource->sender_name,
            'sender_mobile'=> $this->resource->sender_mobile,
            'sender_address' => $this->resource->sender_address,
            'sender_postal_code' => $this->resource->sender_postal_code,
            'receiver_name' => $this->resource->receiver_name,
            'receiver_mobile'=> $this->resource->receiver_mobile,
            'receiver_address' => $this->resource->receiver_address,
            'receiver_postal_code' => $this->resource->receiver_postal_code,
            'parcel_weight' => $this->resource->parcel_weight,
            'barcode' => $this->resource->barcode,
            "created_at" => $this->date_convert($this->resource->created_at),
        ];
    }
}
