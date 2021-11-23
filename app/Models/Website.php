<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'subscriptions',
            'website_id',
            'user_id'
        );
    }
}
