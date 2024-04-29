<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Experience extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school() : BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function company() : HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function project() : HasOne
    {
        return $this->hasOne(Project::class);
    }

    public function getFrenchDates() : string
    {
        Carbon::setLocale('fr');

        $start_date = Carbon::createFromFormat('Y-m-d', $this->start_date)->isoFormat('D MMMM YYYY');
        $end_date   = Carbon::createFromFormat('Y-m-d', $this->end_date)->isoFormat('D MMMM YYYY');

        return $start_date . ' - ' . $end_date;
    }
}
