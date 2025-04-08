<?php

namespace App\Actions\ServidorTemporario;

use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\PessoaEndereco;
use App\Models\ServidorTemporario;
use Illuminate\Support\Facades\DB;

class CreateServidorTemporarioAction
{
    public function perform($data): Pessoa
    {
        return DB::transaction(function () use ($data) {
            $pessoa = Pessoa::create([
                'pes_nome' => $data['pes_nome'],
                'pes_data_nascimento' => $data['pes_data_nascimento'],
                'pes_sexo' => $data['pes_sexo'],
                'pes_mae' => $data['pes_mae'],
                'pes_pai' => $data['pes_pai'],
            ]);

            ServidorTemporario::create([
                'pes_id' => $pessoa->pes_id,
                'st_data_admissao' => $data['st_data_admissao'],
                'st_data_demissao' => $data['st_data_demissao'],
            ]);

            $endereco = Cidade::create([
                'cid_nome' => $data['cid_nome'],
                'cid_uf' => $data['cid_uf'],
            ]);

            $endereco = Endereco::create([
                'end_tipo_logradouro' => $data['end_tipo_logradouro'],
                'end_logradouro' => $data['end_logradouro'],
                'end_numero' => $data['end_numero'],
                'end_bairro' => $data['end_bairro'],
                'cid_id' => $endereco->cid_id,
            ]);

            PessoaEndereco::insert([
                'pes_id' => $pessoa->pes_id,
                'end_id' => $endereco->end_id,
            ]);

            $pessoa->load([
                'ServidorTemporario',
                'enderecos.cidade',
            ]);

            return $pessoa;
        });
    }
}
