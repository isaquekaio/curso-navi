<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projeto extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo', 'gerente_id'];
    //protected $guarded = [];

    public function gerente()
    {
        return $this->belongsTo(User::class);
    }

}
