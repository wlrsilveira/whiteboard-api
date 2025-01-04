<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['email:rfc,dns', 'required', 'unique:users'],
            'password' => ['string', 'required', 'min:8', 'confirmed'],
        ];
    }
}
