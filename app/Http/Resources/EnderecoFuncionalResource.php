<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoFuncionalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pessoa = $this->pessoa;
        $lotacao = $pessoa->lotacoes->first();
        $unidade = $lotacao ? $lotacao->unidade : null;
        $endereco = ($unidade && $unidade->enderecos->isNotEmpty())
            ? $unidade->enderecos->first()
            : null;

        return [
            'nome' => $pessoa->pes_nome,
            'endereco_funcional' => $endereco
                ? "{$endereco->end_logradouro}, {$endereco->end_bairro}"
                : null,
        ];
    }
}
