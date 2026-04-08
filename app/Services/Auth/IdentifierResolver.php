<?php

namespace App\Services\Auth;

class IdentifierResolver
{
    /**
     * Detect whether the identifier is a phone number or email.
     */
    public function detect(string $identifier): string
    {
        return $this->looksLikePhone($identifier) ? 'phone' : 'email';
    }

    /**
     * Normalize identifier to a consistent format.
     * - Phones  → E.164 format (+971XXXXXXXXX)
     * - Emails  → lowercase, trimmed
     */
    public function normalize(string $identifier): string
    {
        $identifier = trim($identifier);

        if ($this->looksLikePhone($identifier)) {
            return $this->normalizePhone($identifier);
        }

        return strtolower($identifier);
    }

    /**
     * Return both channel and normalized identifier in one call.
     *
     * @return array{channel: string, identifier: string}
     */
    public function resolve(string $raw): array
    {
        $identifier = $this->normalize($raw);

        return [
            'channel'    => $this->detect($identifier),
            'identifier' => $identifier,
        ];
    }

    // ─── Private ─────────────────────────────────────────────────────────────────

    private function looksLikePhone(string $value): bool
    {
        // Strip spaces, dashes, parentheses then check if mostly digits
        $stripped = preg_replace('/[\s\-\(\)\+]/', '', $value);

        return preg_match('/^\d{7,15}$/', $stripped) === 1;
    }

    private function normalizePhone(string $phone): string
    {
        // Remove all non-digit characters except leading +
        $phone = preg_replace('/[^\d+]/', '', $phone);

        // UAE local format: 05XXXXXXXX → +97105XXXXXXXX
        if (preg_match('/^05\d{8}$/', $phone)) {
            return '+971' . substr($phone, 1);
        }

        // Already has country code without +
        if (preg_match('/^971\d{9}$/', $phone)) {
            return '+' . $phone;
        }

        // Already E.164
        if (str_starts_with($phone, '+')) {
            return $phone;
        }

        // Fallback: assume UAE
        return '+971' . ltrim($phone, '0');
    }
}
