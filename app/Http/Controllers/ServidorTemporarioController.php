<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServidorTemporarioRequest;
use App\Models\ServidorTemporario;
use Illuminate\Http\Request;

class ServidorTemporarioController extends Controller
{
    public function index()
    {
        $servidores = ServidorTemporario::paginate(10);
        return response()->json($servidores);
    }

    public function show($id)
    {
        $servidor = ServidorTemporario::findOrFail($id);
        return response()->json($servidor);
    }

    public function store(ServidorTemporarioRequest $request)
    {
        $servidor = ServidorTemporario::create($request->validated());
        return response()->json($servidor, 201);
    }

    public function update(ServidorTemporarioRequest $request, $id)
    {
        $servidor = ServidorTemporario::findOrFail($id);
        $servidor->update($request->validated());
        return response()->json($servidor);
    }

    public function destroy($id)
    {
        $servidor = ServidorTemporario::findOrFail($id);
        $servidor->delete();

        return response()->json(null, 204);
    }
}
