<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function student(){
        return $this->hasMany('App\Models\Register')->select('id','department_id','name');
    }
}
