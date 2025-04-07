<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServidorEfetivoUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ser_data_nomeacao' => 'required|date',
        ];
    }
}
