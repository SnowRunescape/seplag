<?php

namespace App\Http\Controllers;

use App\Models\ServidorEfetivo;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class ServidorEfetivoConsultaController extends Controller
{
    /**
     * Consulta os servidores efetivos lotados em uma determinada unidade.
     * Retorna: Nome, idade, unidade de lotação e fotografia.
     *
     * @param  int  $unid_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $unid_id): JsonResponse
    {
        $servidores = ServidorEfetivo::with(['pessoa.lotacoes.unidade', 'pessoa.fotos'])
            ->whereHas('pessoa.lotacoes', function ($query) use ($unid_id) {
                $query->where('unid_id', $unid_id);
            })
            ->paginate(10);

        $data = $servidores->getCollection()->transform(function ($servidor) {
            $pessoa = $servidor->pessoa;
            $idade = Carbon::parse($pessoa->pes_data_nascimento)->age;

            $unidade = $pessoa->lotacoes->first()
                ? optional($pessoa->lotacoes->first()->unidade)->unid_nome
                : null;

            $fotografia = $pessoa->fotos->first() ? $pessoa->fotos->first()->fop_hash : null;

            return [
                'nome'        => $pessoa->pes_nome,
                'idade'       => $idade,
                'unidade'     => $unidade,
                'fotografia'  => $fotografia,
            ];
        });

        $servidores->setCollection($data);
        return response()->json($servidores);
    }
}
