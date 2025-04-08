<?php

namespace App\Http\Controllers;

use App\Http\Requests\FotoUploadRequest;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Realiza o upload de uma ou mais fotografias para o MinIO e retorna links temporários.
     *
     * @param  \App\Http\Requests\FotoUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(FotoUploadRequest $request)
    {
        $links = [];

        foreach ($request->file('fotos') as $file) {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $path = Storage::disk('minio')->putFileAs('fotos', $file, $fileName);

            $temporaryUrl = Storage::disk('minio')->temporaryUrl($path, now()->addMinutes(5));

            $links[] = [
                'file' => $fileName,
                'url'  => $temporaryUrl,
            ];
        }

        return response()->json([
            'message' => 'Upload realizado com sucesso.',
            'data'    => $links,
        ]);
    }
}
