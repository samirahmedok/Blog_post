<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\comments;

class post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','body',
    ];
    public function comments()
    {
        return $this->hasMany('App\Models\comments');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\tags');
    }
}
