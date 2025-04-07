<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    protected $table = 'lotacao';
    protected $primaryKey = 'lot_id';
    public $timestamps = false;

    protected $fillable = [
        'lot_data_inicio',
        'lot_data_fim',
        'unid_id',
        'pes_id',
    ];

    // Relacionamento N:1 com pessoa
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }

    // Relacionamento N:1 com unidade
    public function unidade()
    {
        return $this->belongsTo(Unidade::class, 'unid_id', 'unid_id');
    }
}
