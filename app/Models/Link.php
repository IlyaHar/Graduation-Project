<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    protected $guarded = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
