<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UnidadeEndereco extends Pivot
{
    protected $table = 'unidade_endereco';
    public $timestamps = false;

    protected $fillable = [
        'unid_id',
        'end_id',
    ];
}
