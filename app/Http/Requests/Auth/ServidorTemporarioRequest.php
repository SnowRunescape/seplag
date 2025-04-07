<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServidorTemporarioRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pes_id' => 'required|exists:pessoa,pes_id',
            'ser_data_contratacao' => 'required|date',
        ];
    }
}
