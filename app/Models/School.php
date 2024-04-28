<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function localization() : string
    {
        return $this->street . ' ,' . $this->city . ' ' . $this->zip_code;
    }
}
