<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'user_id', 'description'
    ];

    public function creator(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }


}
