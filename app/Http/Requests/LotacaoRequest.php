<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LotacaoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pes_id'   => 'required|exists:pessoa,pes_id',
            'unid_id'  => 'required|exists:unidade,unid_id',
            'lot_data_lotacao'    => 'required|date',
            'lot_data_remocao' => 'rrequired|date',
            'lot_portaria' => 'required|string|max:100',
        ];
    }
}
