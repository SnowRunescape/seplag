<?php

namespace App\Http\Requests\Unidade;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'unid_nome' => 'required|string|max:200',
            'unid_sigla' => 'required|string|max:20',
        ];
    }
}
