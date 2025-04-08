<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lotacao\LotacaoCreateRequest;
use App\Http\Requests\Lotacao\LotacaoUpdateRequest;
use App\Models\Lotacao;
use Illuminate\Http\Resources\Json\JsonResource;

class LotacaoController extends Controller
{
    public function index()
    {
        $lotacoes = Lotacao::paginate(10);

        return JsonResource::collection($lotacoes);
    }

    public function show($id)
    {
        $lotacao = Lotacao::findOrFail($id);

        return response()->json($lotacao);
    }

    public function store(LotacaoCreateRequest $request)
    {
        $lotacao = Lotacao::create($request->validated());

        return response()->json($lotacao, 201);
    }

    public function update(LotacaoUpdateRequest $request, $id)
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
