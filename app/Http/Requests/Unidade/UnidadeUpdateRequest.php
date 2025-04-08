<?php

namespace App\Http\Requests\Unidade;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'unid_nome' => 'sometimes|string|max:200',
            'unid_sigla' => 'sometimes|string|max:20',
        ];
    }
}
