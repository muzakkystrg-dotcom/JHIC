<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    /**
     * Atribut yang boleh diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'company',
        'category',
        'location',
        'description',
        'logo',
        'posted_at',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'posted_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Slug otomatis dari judul bila belum diisi.
     */
    protected static function booted(): void
    {
        static::saving(function (JobVacancy $vacancy) {
            if (blank($vacancy->slug)) {
                $vacancy->slug = Str::slug($vacancy->title.'-'.$vacancy->company);
            }
        });
    }
}
