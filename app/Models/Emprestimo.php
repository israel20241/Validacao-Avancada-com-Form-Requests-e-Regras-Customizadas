<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimos';

    protected $fillable = [
        'livro_id',
        'user_id',
        'data_emprestimo',
        'data_prevista_devolucao',
        'data_devolucao',
        'status',
        'observacoes',
    ];

    protected $casts = [
        'data_emprestimo' => 'date',
        'data_prevista_devolucao' => 'date',
        'data_devolucao' => 'date',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
