<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function location() : ?string
    {
        $return = null;

        if ($this->street && $this->city && $this->zipcode && $this->country) {
            $return = $this->street . ' ,' . $this->city . ' ' . $this->zipcode . ' ' . $this->country;
        }

        return $return;
    }
}
