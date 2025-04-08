<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'unid_nome'     => 'required|string|max:255',
            'unid_endereco' => 'required|string|max:255',
        ];
    }
}
