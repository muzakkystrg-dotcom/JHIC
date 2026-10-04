<?php

namespace App\Http\Controllers\Industry;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndustryCompanyProfileController extends Controller
{
    /**
     * Profil perusahaan mitra yang sedang login (hanya-baca).
     *
     * Data diambil dari tabel `industries` + config/mitra.php untuk detail
     * tambahan (deskripsi, website, sosial media) yang belum punya kolom
     * di database. Tidak ada lagi data contoh/hardcode.
     */
    public function index()
    {
        $industry = Auth::guard('industry')->user();

        $mitra = config('mitra.'.$industry->slug, []);

        // Saring link sosial: buang yang cuma menunjuk ke root domain (placeholder).
        $isRealLink = static function (?string $url): bool {
            if (blank($url)) {
                return false;
            }

            $path = trim((string) parse_url($url, PHP_URL_PATH), '/');

            return $path !== '';
        };

        $profile = [
            'name' => $industry->company_name ?? ($mitra['nama'] ?? 'Mitra Industri'),
            'logo' => $industry->logo ? asset($industry->logo) : asset('images/mitra/gt.webp'),
            'industry_id' => $industry->industry_id,
            'email' => $industry->email,
            'address' => $industry->address ?? ($mitra['alamat'] ?? null),
            'website' => $mitra['website_url'] ?? null,
            'website_label' => $mitra['website_label'] ?? null,
            'linkedin' => $isRealLink($mitra['linkedin'] ?? null) ? $mitra['linkedin'] : null,
            'instagram' => $isRealLink($mitra['instagram'] ?? null) ? $mitra['instagram'] : null,
        ];

        return view('pages.industry.dashboard.company-profile', compact('industry', 'profile'));
    }
}
