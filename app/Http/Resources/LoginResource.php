<?php

namespace App\Http\Resources;

class LoginResource extends UserResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'access_token' => $this->access_token,
        ]);
    }
}
