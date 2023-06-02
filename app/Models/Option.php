<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends BaseModel
{


    public function optionGroup(){
        return $this->belongsTo('App\Models\OptionGroup','group_id')->withDefault();
    }
    
    public function scopePaymentMethod($query){
        $query->where('group_id', 3);

        return $query;
    }

    

}
