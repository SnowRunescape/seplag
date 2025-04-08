<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServidorTemporarioRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pes_nome' => 'required|string|max:200',
            'pes_data_nascimento' => 'required|date',
            'pes_sexo' => 'required|string|in:masculino,feminino',
            'pes_mae' => 'required|string|max:200',
            'pes_pai' => 'required|string|max:200',
            'st_data_admissao' => 'required|date',
            'st_data_demissao' => 'required|date',
            'end_tipo_logradouro' => 'required|string|max:50',
            'end_logradouro' => 'required|string|max:200',
            'end_numero' => 'required|int',
            'end_bairro' => 'required|string|max:100',
            'cid_nome' => 'required|string|max:200',
            'cid_uf' => 'required|string|max:2',
        ];
    }
}
