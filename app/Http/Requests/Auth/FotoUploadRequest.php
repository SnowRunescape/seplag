<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FotoUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fotos'   => 'required|array',
            'fotos.*' => 'file|image|max:2048',
        ];
    }
}
