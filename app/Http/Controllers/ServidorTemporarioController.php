<?php

namespace App\Http\Controllers;

use App\Actions\ServidorTemporario\CreateServidorTemporarioAction;
use App\Actions\ServidorTemporario\UpdateServidorTemporarioAction;
use App\Http\Requests\ServidorTemporario\ServidorTemporarioCreateRequest;
use App\Http\Requests\ServidorTemporario\ServidorTemporarioUpdateRequest;
use App\Models\Pessoa;

class ServidorTemporarioController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::whereHas('servidorTemporario')->with([
            'servidorTemporario',
            'enderecos.cidade',
        ])
        ->paginate(10);

        return response()->json($pessoas);
    }

    public function show(int $id)
    {
        $pessoa = Pessoa::whereHas('servidorTemporario')->with([
            'servidorTemporario',
            'enderecos.cidade',
        ])->findOrFail($id);

        return response()->json($pessoa);
    }

    public function store(CreateServidorTemporarioAction $action, ServidorTemporarioCreateRequest $request)
    {
        $pessoa = $action->perform($request->validated());

        return response()->json($pessoa, 201);
    }

    public function update(ServidorTemporarioUpdateRequest $request, int $id)
    {
        $pessoa = Pessoa::findOrFail($id);

        $action = new UpdateServidorTemporarioAction($pessoa);
        $action->perform($request->validated());

        $pessoa->load([
            'servidorTemporario',
            'enderecos.cidade',
        ]);

        return response()->json($pessoa);
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::whereHas('servidorTemporario')->findOrFail($id);
        $pessoa->delete();

        return response()->json(null, 204);
    }
}
