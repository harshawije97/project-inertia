<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feature extends Model
{
    public function upvotes(): HasMany
    {
        return $this->hasMany(Upvote::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class);
    }
    // This model owns a foreign key that belongs to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
