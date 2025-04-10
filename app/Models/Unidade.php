<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidade';
    protected $primaryKey = 'unid_id';

    protected $fillable = [
        'unid_nome',
        'unid_sigla',
    ];

    public function lotacoes()
    {
        return $this->hasMany(Lotacao::class, 'unid_id', 'unid_id');
    }

    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class, 'unidade_endereco', 'unid_id', 'end_id')
            ->using(UnidadeEndereco::class);
    }
}
