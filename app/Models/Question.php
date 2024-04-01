<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'type',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function($id){
            $id->slug = Str::slug(ucfirst($id->type));
        });


    }

    protected $table = 'questions';

}
