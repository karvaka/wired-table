<?php

namespace Karvaka\Wired\Table;

use Illuminate\Support\Str;

final class Utils
{
    protected static ?string $translationKeyPrefix = 'validation.attributes.';

    public static function translationKeyPrefix(?string $prefix): void
    {
        self::$translationKeyPrefix = $prefix;
    }

    public static function translate(string $attribute): ?string
    {
        return trans()->has(self::$translationKeyPrefix . $attribute) ?
            trans(self::$translationKeyPrefix . $attribute) : null;
    }

    public static function humanize($attribute): string
    {
        return Str::of((is_object($attribute) ? class_basename($attribute) : $attribute))
            ->snake()->replace(['_', '-', '.'], ' ')->title();
    }
}
