<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServidorTemporario extends Model
{
    protected $table = 'servidor_temporario';
    protected $primaryKey = 'pes_id'; // Se 'pes_id' for a PK única
    public $timestamps = false;

    protected $fillable = [
        'pes_id',
        'ser_data_inicio',
        'ser_data_fim',
    ];

    // Relacionamento 1:1 inverso com pessoa
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
}
