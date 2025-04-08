<?php

namespace App\Http\Requests\ServidorEfetivo;

use Illuminate\Foundation\Http\FormRequest;

class ServidorEfetivoUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pes_nome' => 'sometimes|string|max:200',
            'pes_data_nascimento' => 'sometimes|date',
            'pes_sexo' => 'sometimes|string|in:masculino,feminino',
            'pes_mae' => 'sometimes|string|max:200',
            'pes_pai' => 'sometimes|string|max:200',
            'se_matricula' => 'sometimes|string|max:20',
        ];
    }
}
