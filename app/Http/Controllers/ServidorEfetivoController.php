<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServidorEfetivoRequest;
use App\Http\Requests\ServidorEfetivoUpdateRequest;
use App\Models\ServidorEfetivo;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class ServidorEfetivoController extends Controller
{
    /**
     * Exibe uma listagem paginada de Servidores Efetivos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $servidores = ServidorEfetivo::paginate(10);

        return response()->json($servidores);
    }

    /**
     * Armazena um novo registro de Servidor Efetivo.
     *
     * @param  \App\Http\Requests\ServidorEfetivoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ServidorEfetivoRequest $request)
    {
        $servidorEfetivo = ServidorEfetivo::create($request->validated());

        return response()->json($servidorEfetivo, 201);
    }

    /**
     * Exibe um registro específico de Servidor Efetivo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $servidorEfetivo = ServidorEfetivo::findOrFail($id);

        return response()->json($servidorEfetivo);
    }

    /**
     * Atualiza um registro de Servidor Efetivo.
     *
     * @param  \App\Http\Requests\ServidorEfetivoUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ServidorEfetivoUpdateRequest $request)
    {
        $id = $request->id;

        $servidorEfetivo = ServidorEfetivo::findOrFail($id);
        $servidorEfetivo->update($request->validated());

        return response()->json($servidorEfetivo);
    }

    /**
     * Remove um registro de Servidor Efetivo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $servidorEfetivo = ServidorEfetivo::findOrFail($id);
        $servidorEfetivo->delete();

        return response()->json(null, 204);
    }

    /**
     * Consulta os servidores efetivos lotados em uma determinada unidade.
     * Retorna: Nome, idade, unidade de lotação e fotografia.
     *
     * @param  int  $unid_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function byUnidade(int $unid_id)
    {
        $servidores = ServidorEfetivo::with(['pessoa.lotacoes.unidade', 'pessoa.fotos'])
            ->whereHas('pessoa.lotacoes', function ($query) use ($unid_id) {
                $query->where('unid_id', $unid_id);
            })
            ->paginate(10);

        $data = $servidores->getCollection()->transform(function ($servidor) {
            $pessoa = $servidor->pessoa;
            $idade = Carbon::parse($pessoa->pes_data_nascimento)->age;

            // Considera a primeira lotação para obter a unidade
            $unidade = $pessoa->lotacoes->first()
                ? optional($pessoa->lotacoes->first()->unidade)->unid_nome
                : null;

            // Considera a primeira foto, se houver
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
