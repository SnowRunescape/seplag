<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait UpdatePessoaTrait
{
    private function updatePessoa($data)
    {
        $data = Arr::only($data, [
            'pes_nome',
            'pes_data_nascimento',
            'pes_sexo',
            'pes_mae',
            'pes_pai',
        ]);

        if (empty($data)) {
            return;
        }

        $this->pessoa->update($data);
    }
}
