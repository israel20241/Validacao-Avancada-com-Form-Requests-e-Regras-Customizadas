<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'genero_id',
        'editora',
        'numero_paginas',
        'autor_id',
        'user_id',
        'data_publicacao',
        'capa',
    ];
    
    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function editora()
    {
        return $this->belongsTo(Editora::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

}
