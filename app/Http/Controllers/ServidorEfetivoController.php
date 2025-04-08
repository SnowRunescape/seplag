<?php

namespace App\Http\Controllers;

use App\Actions\CreateServidorEfetivadoAction;
use App\Actions\UpdateServidorEfetivadoAction;
use App\Http\Requests\ServidorEfetivoRequest;
use App\Http\Requests\ServidorEfetivoUpdateRequest;
use App\Models\Pessoa;
use App\Models\ServidorEfetivo;

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
    public function store(
        CreateServidorEfetivadoAction $action,
        ServidorEfetivoRequest $request
    ) {
        $pessoa = $action->perform($request->validated());

        return response()->json($pessoa, 201);
    }

    /**
     * Exibe um registro específico de Servidor Efetivo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $pessoa = Pessoa::with([
            'servidorEfetivo',
            'enderecos.cidade',
        ])->findOrFail($id);

        return response()->json($pessoa);
    }

    /**
     * Atualiza um registro de Servidor Efetivo.
     *
     * @param  \App\Http\Requests\ServidorEfetivoUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        ServidorEfetivoUpdateRequest $request,
        int $id
    ) {
        $pessoa = Pessoa::findOrFail($id);

        $action = new UpdateServidorEfetivadoAction($pessoa);
        $action->perform($request->validated());

        $pessoa->load([
            'servidorEfetivo',
            'enderecos.cidade',
        ]);

        return response()->json($pessoa);
    }

    /**
     * Remove um registro de Servidor Efetivo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();

        return response()->json(null, 204);
    }
}
