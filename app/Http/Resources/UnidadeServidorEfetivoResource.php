<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UnidadeServidorEfetivoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pessoa = $this->pessoa;
        $idade = Carbon::parse($pessoa->pes_data_nascimento)->age;

        $unidade = $pessoa->lotacoes->first()
            ? optional($pessoa->lotacoes->first()->unidade)->unid_nome
            : null;


        $fotografia = $pessoa->fotos->first() ? $pessoa->fotos->first()->fop_hash : null;

        if ($fotografia) {
            $fotografia = Storage::disk()->temporaryUrl(
                "fotos/{$fotografia}",
                now()->addMinutes(5)
            );
        }

        return [
            'nome' => $pessoa->pes_nome,
            'idade' => $idade,
            'unidade' => $unidade,
            'fotografia' => $fotografia,
        ];
    }
}
