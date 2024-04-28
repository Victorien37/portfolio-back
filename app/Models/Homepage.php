<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Homepage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
