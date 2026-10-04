<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'industry_id',
        'title',
        'category',
        'location',
        'description',
        'is_active',
    ];

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
