<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
    public function status(){
        return $this->belongsTo('\App\Models\Option', 'status_id');
    }

    public function getAuthorNameAttribute(){
        return $this->createdBy->name;
    }

    public function getStatusNameAttribute(){
        return $this->status->name;
    }
    
}
