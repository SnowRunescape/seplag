<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnidadeServidorEfetivoResource;
use App\Models\ServidorEfetivo;

class UnidadeServidorEfetivoController extends Controller
{
    /**
     * Consulta os servidores efetivos lotados em uma determinada unidade.
     * Retorna: Nome, idade, unidade de lotação e fotografia.
     *
     * @param  int  $unid_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $unid_id)
    {
        $servidores = ServidorEfetivo::with(['pessoa.lotacoes.unidade', 'pessoa.fotos'])
            ->whereHas('pessoa.lotacoes', function ($query) use ($unid_id) {
                $query->where('unid_id', $unid_id);
            })
            ->paginate(10);

        return UnidadeServidorEfetivoResource::collection($servidores);
    }
}
