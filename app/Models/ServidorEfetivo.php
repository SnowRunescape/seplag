<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServidorEfetivo extends Model
{
    protected $table = 'servidor_efetivo';
    protected $primaryKey = 'pes_id'; // Se 'pes_id' for a PK única
    public $timestamps = false;

    protected $fillable = [
        'pes_id',
        'ser_data_nomeacao',
    ];

    // Relacionamento 1:1 inverso com pessoa
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
}
