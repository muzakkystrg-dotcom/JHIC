<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Alumni extends Model
{
    /**
     * Nama tabel eksplisit.
     *
     * @var string
     */
    protected $table = 'alumnis';

    /**
     * Atribut yang boleh diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_siswa',
        'slug',
        'sso',
        'jurusan',
        'dtp',
    ];

    /**
     * Slug otomatis dari nama siswa bila belum diisi.
     */
    protected static function booted(): void
    {
        static::saving(function (Alumni $alumni) {
            if (blank($alumni->slug)) {
                $alumni->slug = static::uniqueSlug($alumni->nama_siswa, $alumni->sso, $alumni->id);
            }
        });
    }

    /**
     * Buat slug unik; kalau bentrok, tambahkan SSO atau angka urut.
     */
    public static function uniqueSlug(string $nama, ?string $sso = null, ?int $ignoreId = null): string
    {
        $base = Str::slug($nama);
        $slug = $base;
        $i = 1;

        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base.'-'.($sso ?: $i++);
        }

        return $slug;
    }
}
