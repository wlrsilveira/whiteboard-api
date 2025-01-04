<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WhiteboardQrCodeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource['whiteboard']->id,
            'identifier' => $this->resource['whiteboard']->identifier,
            'qr_code' => $this->resource['qr_code'],
        ];
    }
}
