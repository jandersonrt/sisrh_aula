<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;

    protected $fillable = ['descricao','status'];

    public function funcionarios() {
        return $this->belongsToMany(Funcionario::class, 'beneficio_funcionario', 'beneficio_id','funcionario_id');
    }
}
