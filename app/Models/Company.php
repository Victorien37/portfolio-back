<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function experiences() : HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function image() : HasOne
    {
        return $this->hasOne(Image::class);
    }
}
