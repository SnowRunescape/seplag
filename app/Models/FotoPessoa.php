<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoPessoa extends Model
{
    protected $table = 'foto_pessoa';
    protected $primaryKey = 'fop_id';
    public $timestamps = false;

    protected $fillable = [
        'pes_id',
        'fop_data',
        'fop_bucket',
        'fop_hash',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }
}
