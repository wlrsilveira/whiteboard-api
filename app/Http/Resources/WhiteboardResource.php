<?php

namespace App\Http\Resources;

use App\Services\WhiteboardService;
use Illuminate\Http\Resources\Json\JsonResource;

class WhiteboardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'identifier' => $this->identifier,
            'qrCode' => resolve(WhiteboardService::class)->generateQrCode($this->resource),
            'user' => $this->whenLoaded('user', function () {
                return UserResource::make($this->user);
            }),
        ];
    }
}
