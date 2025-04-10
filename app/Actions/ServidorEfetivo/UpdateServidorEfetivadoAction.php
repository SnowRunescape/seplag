<?php

namespace App\Actions\ServidorEfetivo;

use App\Models\Pessoa;
use App\Traits\UpdatePessoaTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateServidorEfetivadoAction
{
    use UpdatePessoaTrait;

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

    private function updateServidorEfetivo($data)
    {
        $data = Arr::only($data, [
            'se_matricula',
        ]);

        if (empty($data)) {
            return;
        }

        $this->pessoa->servidorEfetivo->update($data);
    }
}
