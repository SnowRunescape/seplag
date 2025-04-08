<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServidorTemporario extends Model
{
    protected $table = 'servidor_temporario';
    protected $primaryKey = 'pes_id';

    protected $fillable = [
        'pes_id',
        'ser_data_inicio',
        'ser_data_fim',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
}
