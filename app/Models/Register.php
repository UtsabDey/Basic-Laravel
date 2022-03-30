<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    public function dept(){
        return $this->belongsTo('App\Models\Department','department_id', 'id')->withDefault();
    }
}
