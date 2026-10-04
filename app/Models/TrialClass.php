<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrialClass extends Model
{
    /**
     * Atribut yang boleh diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'jurusan',
        'tanggal',
        'jam',
        'instruktur',
        'kuota',
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
            'tanggal' => 'date',
            'kuota' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Tanggal dalam format Indonesia, mis. "10 Februari 2026".
     */
    protected function tanggalFormatted(): Attribute
    {
        return Attribute::get(
            fn () => $this->tanggal?->locale('id')->translatedFormat('d F Y')
        );
    }

    /**
     * Slug otomatis dari judul bila belum diisi.
     */
    protected static function booted(): void
    {
        static::saving(function (TrialClass $trialClass) {
            if (blank($trialClass->slug)) {
                $trialClass->slug = Str::slug($trialClass->judul);
            }
        });
    }
}
