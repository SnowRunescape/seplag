<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnderecoFuncionalRequest;
use App\Models\ServidorEfetivo;
use Illuminate\Http\JsonResponse;

class EnderecoFuncionalController extends Controller
{
    /**
     * Consulta o endereço funcional da unidade onde o servidor efetivo é lotado,
     * utilizando parte do nome do servidor efetivo.
     *
     * @param  \App\Http\Requests\EnderecoFuncionalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EnderecoFuncionalRequest $request): JsonResponse
    {
        $servidores = ServidorEfetivo::with(['pessoa.lotacoes.unidade.enderecos'])
            ->whereHas('pessoa', function ($query) use ($request) {
                $query->where('pes_nome', 'ilike', "%{$request->nome}%");
            })
            ->get();

        $data = $servidores->map(function ($servidor) {
            $pessoa   = $servidor->pessoa;
            $lotacao  = $pessoa->lotacoes->first();
            $unidade  = $lotacao ? $lotacao->unidade : null;
            $endereco = ($unidade && $unidade->enderecos->isNotEmpty())
                ? $unidade->enderecos->first()
                : null;

            return [
                'nome' => $pessoa->pes_nome,
                'endereco_funcional' => $endereco
                    ? "{$endereco->end_logradouro}, {$endereco->end_bairro}"
                    : null,
            ];
        });

        return response()->json($data);
    }
}
