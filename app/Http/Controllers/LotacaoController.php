<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotacaoRequest;
use App\Models\Lotacao;

class LotacaoController extends Controller
{
    public function index()
    {
        $lotacoes = Lotacao::paginate(10);
        return response()->json($lotacoes);
    }

    public function show($id)
    {
        $lotacao = Lotacao::findOrFail($id);

        return response()->json($lotacao);
    }

    public function store(LotacaoRequest $request)
    {
        $lotacao = Lotacao::create($request->validated());

        return response()->json($lotacao, 201);
    }

    public function update(LotacaoRequest $request, $id)
    {
        $lotacao = Lotacao::findOrFail($id);
        $lotacao->update($request->validated());

        return response()->json($lotacao);
    }

    /**
     * Remove um registro de Lotação.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $lotacao = Lotacao::findOrFail($id);
        $lotacao->delete();

        return response()->json(null, 204);
    }
}
