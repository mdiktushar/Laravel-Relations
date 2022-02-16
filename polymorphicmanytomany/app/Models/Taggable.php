<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function tags(Type $var = null)
    {
        # code...
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
