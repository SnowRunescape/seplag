<?php

namespace App\Http\Controllers;

use App\Http\Requests\FotoUploadRequest;
use App\Models\FotoPessoa;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Realiza o upload de uma ou mais fotografias para o MinIO e retorna links temporários.
     *
     * @param  \App\Http\Requests\FotoUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FotoUploadRequest $request)
    {
        $links = [];

        foreach ($request->file('fotos') as $file) {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $path = Storage::disk()->putFileAs('fotos', $file, $fileName);

            $temporaryUrl = Storage::disk()->temporaryUrl($path, now()->addMinutes(5));

            FotoPessoa::create([
                'pes_id'     => $request->pes_id,
                'fop_data'   => now(),
                'fop_bucket' => config('filesystems.disks.' . config('filesystems.default') . '.bucket'),
                'fop_hash'   => $fileName,
            ]);

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
