<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeRequest;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::paginate(10);
        return response()->json($unidades);
    }

    public function show($id)
    {
        $unidade = Unidade::findOrFail($id);
        return response()->json($unidade);
    }

    public function store(UnidadeRequest $request)
    {
        $unidade = Unidade::create($request->validated());
        return response()->json($unidade, 201);
    }

    public function update(UnidadeRequest $request, $id)
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
