<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image() : BelongsTo
    {
        return $this->BelongsTo(Image::class);
    }

    public function experience() : BelongsTo
    {
        return $this->BelongsTo(Experience::class);
    }
}
