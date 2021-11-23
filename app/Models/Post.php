<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'title',
        'description'
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function deliveries(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'deliveries',
            'post_id',
            'user_id'
        );
    }
}
