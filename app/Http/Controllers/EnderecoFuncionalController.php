<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnderecoFuncionalRequest;
use App\Http\Resources\EnderecoFuncionalResource;
use App\Models\ServidorEfetivo;

class EnderecoFuncionalController extends Controller
{
    /**
     * Consulta o endereço funcional da unidade onde o servidor efetivo é lotado,
     * utilizando parte do nome do servidor efetivo.
     *
     * @param  \App\Http\Requests\EnderecoFuncionalRequest $request
     * @return \App\Http\Resources\EnderecoFuncionalResource
     */
    public function index(EnderecoFuncionalRequest $request)
    {
        $servidores = ServidorEfetivo::with(['pessoa.lotacoes.unidade.enderecos'])
            ->whereHas('pessoa', function ($query) use ($request) {
                $query->where('pes_nome', 'ilike', "%{$request->nome}%");
            })
            ->paginate(10);

        return EnderecoFuncionalResource::collection($servidores);
    }
}
