<?php

namespace App\Actions;

use App\Models\Pessoa;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateServidorEfetivadoAction
{
    public function __construct(
        private Pessoa $pessoa
    ) {
    }

    public function perform($data)
    {
        DB::transaction(function () use ($data) {
            $this->updatePessoa($data);
            $this->updateServidorEfetivo($data);
        });
    }

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

    private function updateServidorEfetivo($data)
    {
        $data = Arr::only($data, [
            'se_matricula',
        ]);

        if (empty($data)) {
            return;
        }

        $this->pessoa->servidorEfetivo->update([
            'se_matricula' => $data['se_matricula'],
        ]);
    }
}
