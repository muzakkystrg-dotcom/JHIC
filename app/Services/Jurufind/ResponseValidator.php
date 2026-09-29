<?php

namespace App\Services\Jurufind;

class ResponseValidator
{
    /** Validasi bentuk JSON balikan AI sebelum dipercaya. */
    public static function isValid(mixed $data): bool
    {
        if (! is_array($data)) {
            return false;
        }

        if (! in_array($data['primaryMajor'] ?? null, ['SIJA', 'TJAT'], true)) {
            return false;
        }
        if (! is_string($data['summary'] ?? null) || trim($data['summary']) === '') {
            return false;
        }

        if (! is_array($data['reasons'] ?? null)) {
            return false;
        }
        foreach ($data['reasons'] as $reason) {
            if (! is_string($reason)) {
                return false;
            }
        }

        if (! is_array($data['topInterests'] ?? null)) {
            return false;
        }
        foreach ($data['topInterests'] as $item) {
            if (! is_array($item)) {
                return false;
            }
            if (! is_string($item['name'] ?? null)) {
                return false;
            }
            if (! is_numeric($item['score'] ?? null)) {
                return false;
            }
        }

        if (! is_string($data['comparison'] ?? null)) {
            return false;
        }

        return true;
    }
}
