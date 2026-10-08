<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostImage extends Model
{
    protected $fillable = [
        'post_id',
        'image_path',
    ];

    public function post(): BelongsTo //esta imagen pertenece a un post, por eso usamos belongsTo.
    {
        return $this->belongsTo(Post::class);
    }
}
