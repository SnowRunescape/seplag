<?php

namespace App\Http\Controllers;

use App\Models\ServidorEfetivo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EnderecoFuncionalController extends Controller
{
    /**
     * Consulta o endereço funcional da unidade onde o servidor efetivo é lotado,
     * utilizando parte do nome do servidor efetivo.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $nome = $request->query('nome');

        if (!$nome) {
            return response()->json(['error' => 'Parâmetro "nome" é obrigatório.'], 422);
        }

        $servidores = ServidorEfetivo::with(['pessoa.lotacoes.unidade.enderecos'])
            ->whereHas('pessoa', function ($query) use ($nome) {
                $query->where('pes_nome', 'ilike', "%{$nome}%");
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
                'nome'                => $pessoa->pes_nome,
                'endereco_funcional'  => $endereco
                    ? "{$endereco->end_logradouro}, {$endereco->end_bairro}"
                    : null,
            ];
        });

        return response()->json($data);
    }
}
