<?php

namespace App\Http\Requests\ServidorTemporario;

use Illuminate\Foundation\Http\FormRequest;

class ServidorTemporarioUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pes_nome' => 'sometimes|string|max:200',
            'pes_data_nascimento' => 'sometimes|date',
            'pes_sexo' => 'sometimes|string|in:masculino,feminino',
            'pes_mae' => 'sometimes|string|max:200',
            'pes_pai' => 'sometimes|string|max:200',
            'st_data_admissao' => 'sometimes|date',
            'st_data_demissao' => 'sometimes|date',
            'end_tipo_logradouro' => 'sometimes|string|max:50',
            'end_logradouro' => 'sometimes|string|max:200',
            'end_numero' => 'sometimes|int',
            'end_bairro' => 'sometimes|string|max:100',
            'cid_nome' => 'sometimes|string|max:200',
            'cid_uf' => 'sometimes|string|max:2',
        ];
    }
}
