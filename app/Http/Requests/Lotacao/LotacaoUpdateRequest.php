<?php

namespace App\Http\Requests\Lotacao;

use Illuminate\Foundation\Http\FormRequest;

class LotacaoUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lot_data_lotacao' => 'sometimes|date',
            'lot_data_remocao' => 'sometimes|date',
            'lot_portaria' => 'sometimes|string|max:100',
        ];
    }
}
