<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends BaseModel
{
    

    public function options(){
        return $this->hasMany('App\Models\Option','group_id');
    }
}
