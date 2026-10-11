<?php

declare(strict_types=1);

enum Locale: string
{
    case DeDe = 'de-DE';
    case FrFr = 'fr-FR';

    public function language(): string
    {
        return substr($this->value, 0, 2);
    }
}

final class LanguageResolver
{
    private const MAP = [
        'DE' => Locale::DeDe,
        'FR' => Locale::FrFr,
    ];

    public function resolve(string $country): ?string
    {
        if (!isset(self::MAP[$country])) {
            return null;
        }

        return self::MAP[$country]->language();
    }
}
