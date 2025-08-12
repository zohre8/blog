<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Photo extends Model
{
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'name',
        'path',
        'user_id',
    ];
    protected $uploads= '/images/';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getPathAttribute($photo)
    {
        return $this->uploads .$photo;
    }
}
