<?php

namespace App\Http\Controllers;

use App\Actions\ServidorEfetivo\CreateServidorEfetivadoAction;
use App\Actions\ServidorEfetivo\UpdateServidorEfetivadoAction;
use App\Http\Requests\ServidorEfetivo\ServidorEfetivoCreateRequest;
use App\Http\Requests\ServidorEfetivo\ServidorEfetivoUpdateRequest;
use App\Models\Pessoa;

class ServidorEfetivoController extends Controller
{
    /**
     * Exibe uma listagem paginada de Servidores Efetivos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pessoas = Pessoa::whereHas('servidorEfetivo')->with([
            'servidorEfetivo',
            'enderecos.cidade',
        ])
        ->paginate(10);

        return response()->json($pessoas);
    }

    /**
     * Armazena um novo registro de Servidor Efetivo.
     *
     * @param  \App\Actions\ServidorEfetivo\CreateServidorEfetivadoAction $action
     * @param  \App\Http\Requests\ServidorEfetivo\ServidorEfetivoCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        CreateServidorEfetivadoAction $action,
        ServidorEfetivoCreateRequest $request
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
        $pessoa = Pessoa::whereHas('servidorEfetivo')->with([
            'servidorEfetivo',
            'enderecos.cidade',
        ])->findOrFail($id);

        return response()->json($pessoa);
    }

    /**
     * Atualiza um registro de Servidor Efetivo.
     *
     * @param  \App\Http\Requests\ServidorEfetivo\ServidorEfetivoUpdateRequest $request
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
