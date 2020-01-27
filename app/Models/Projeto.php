<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Projeto extends Model
{
    protected $fillable = ['titulo', 'gerente_id'];
    //protected $guarded = [];

    public function gerente()
    {
        return $this->belongsTo(User::class);
    }

}
