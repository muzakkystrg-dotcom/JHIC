<?php

namespace App\Services\Chatbot;

class GuardrailService
{
    /**
     * Kata kunci yang hampir pasti di luar topik sekolah. SENGAJA longgar —
     * hanya menangkap kasus yang jelas, supaya pertanyaan sekolah yang valid
     * tidak ikut tertolak. Pertahanan utama tetap di system prompt.
     */
    private const OFF_TOPIC_PATTERNS = [
        'buatkan kode', 'buatin kode', 'tulis kode', 'tuliskan kode',
        'bikinin program', 'buatkan program', 'buatkan aplikasi',
        'kerjain pr', 'kerjakan pr', 'kerjain tugas', 'kerjakan tugas',
        'jawab soal matematika', 'jawab soal fisika', 'jawab soal',
        'terjemahkan', 'translate kalimat',
        'resep masakan', 'resep kue',
        'ramalan', 'zodiak',
        'buatkan puisi', 'buatkan cerita', 'buatkan pantun',
        'rekomendasi film', 'rekomendasi lagu',
        'cuaca hari ini', 'cuaca besok',
        'harga saham', 'harga bitcoin',
    ];

    public static function isObviouslyOffTopic(string $message): bool
    {
        $lower = mb_strtolower($message);
        foreach (self::OFF_TOPIC_PATTERNS as $pattern) {
            if (str_contains($lower, $pattern)) {
                return true;
            }
        }

        return false;
    }

    public static function refusalMessage(): string
    {
        return 'Maaf, aku cuma bisa bantu soal informasi SMK Telkom Sidoarjo ya — coba tanya soal jurusan (SIJA/TJAT), PPDB, fasilitas, ekstrakurikuler, atau program sekolah lainnya 🙂';
    }
}
