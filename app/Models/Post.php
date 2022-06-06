<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['parent_id', 'file'];

    use HasFactory;
    public function children()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }
}
