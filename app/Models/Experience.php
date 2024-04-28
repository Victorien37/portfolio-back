<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Experience extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school() : HasOne
    {
        return $this->hasOne(School::class);
    }

    public function company() : HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function project() : HasOne
    {
        return $this->hasOne(Project::class);
    }
}
