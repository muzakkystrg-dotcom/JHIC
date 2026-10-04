<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Industry extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'industry_id',
        'slug',
        'company_name',
        'password',
        'logo',
        'email',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
}
