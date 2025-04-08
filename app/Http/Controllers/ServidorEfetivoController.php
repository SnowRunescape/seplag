<?php

namespace App\Http\Controllers;

use App\Actions\CreateServidorEfetivadoAction;
use App\Http\Requests\ServidorEfetivoRequest;
use App\Http\Requests\ServidorEfetivoUpdateRequest;
use App\Models\ServidorEfetivo;
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
}
