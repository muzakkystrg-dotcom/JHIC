<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    /**
     * Nama tabel eksplisit.
     *
     * @var string
     */
    protected $table = 'prestasis';

    /**
     * Atribut yang boleh diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'level',
        'description',
        'image',
    ];

    /**
     * Slug otomatis dari judul bila belum diisi.
     */
    protected static function booted(): void
    {
        static::saving(function (Prestasi $prestasi) {
            if (blank($prestasi->slug)) {
                $prestasi->slug = Str::slug($prestasi->title);
            }
        });
    }
}
