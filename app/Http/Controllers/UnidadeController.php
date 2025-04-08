<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unidade\UnidadeCreateRequest;
use App\Http\Requests\Unidade\UnidadeUpdateRequest;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::paginate(10);

        return response()->json($unidades);
    }

    public function show(int $id)
    {
        $unidade = Unidade::findOrFail($id);

        return response()->json($unidade);
    }

    public function store(UnidadeCreateRequest $request)
    {
        $unidade = Unidade::create($request->validated());

        return response()->json($unidade, 201);
    }

    public function update(UnidadeUpdateRequest $request, int $id)
    {
        $unidade = Unidade::findOrFail($id);
        $unidade->update($request->validated());

        return response()->json($unidade);
    }

    public function destroy($id)
    {
        $unidade = Unidade::findOrFail($id);
        $unidade->delete();

        return response()->json(null, 204);
    }
}
