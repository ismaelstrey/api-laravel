<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'name',
        'image',
        'cpf_cnpj'
    ];

    public function rules()
    {
        return [
            'name' => 'required',
            'cpf_cnpj' => 'required|unique:clientes'
        ];
    }
}
