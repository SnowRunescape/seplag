<?php

namespace App\Actions\ServidorTemporario;

use App\Models\Pessoa;
use App\Traits\UpdatePessoaTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateServidorTemporarioAction
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
            $this->updateServidorTemporario($data);
        });
    }

    private function updateServidorTemporario($data)
    {
        $data = Arr::only($data, [
            'st_data_admissao',
            'st_data_demissao',
        ]);

        if (empty($data)) {
            return;
        }

        $this->pessoa->servidorTemporario->update($data);
    }
}
