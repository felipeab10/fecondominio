<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class condominioAdmin extends Model
{
    use Notifiable;

    protected $fillable = [
        'nome', 'cnpj', 'dt_inauguracao', 'cep','endereco', 'numero', 'bairro','complemento', 'cidade','estado',
    
    ];
}
