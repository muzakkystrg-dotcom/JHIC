<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'sso',
    'full_name',
    'email',
    'phone',
    'linkedin',
    'resume_path',
    'portfolio_path',
    'skills',
    'job_interest',
    'work_preference',
    'start_date',
    'status',
])]
class JobApplication extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'start_date' => 'date',
        ];
    }
}
