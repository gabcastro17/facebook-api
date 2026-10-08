<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
     protected $fillable = [ //fillable: Estas son las columnas que permitimos llenar mediante asignación masiva.
        'title',
        'content',
        'likes_count',
    ];

    public function images(): HasMany //un post tiene muchas imagenes, por eso usamos hasMany.
    {
        return $this->hasMany(PostImage::class);
    }

    public function comments(): HasMany //un post tiene muchos comentarios, por eso usamos hasMany.
    {

        return $this->hasMany(Comment::class);
    }
}