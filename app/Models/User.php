<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email'];
    use HasFactory;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
