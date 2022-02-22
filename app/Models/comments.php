<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\post;


class comments extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    public function posts()
    {
        return $this->belongsTo('App\Models\post');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
