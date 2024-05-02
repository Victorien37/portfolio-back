<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function experiences() : HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function projects() : HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
