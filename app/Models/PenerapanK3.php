<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PenerapanK3 extends Model
{
    /**
     * Nama tabel eksplisit.
     *
     * @var string
     */
    protected $table = 'penerapan_k3s';

    /**
     * Atribut yang boleh diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_file',
        'slug',
        'file_size',
        'file_path',
        'uploaded_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'uploaded_at' => 'date',
        ];
    }

    /**
     * Tanggal unggah dalam format Indonesia, mis. "12 Januari 2025".
     */
    protected function uploadedAtFormatted(): Attribute
    {
        return Attribute::get(
            fn () => $this->uploaded_at?->locale('id')->translatedFormat('d F Y')
        );
    }

    /**
     * Slug otomatis dari nama file bila belum diisi.
     */
    protected static function booted(): void
    {
        static::saving(function (PenerapanK3 $dokumen) {
            if (blank($dokumen->slug)) {
                $dokumen->slug = Str::slug(
                    Str::replaceLast('.pdf', '', $dokumen->nama_file)
                );
            }
        });
    }
}
