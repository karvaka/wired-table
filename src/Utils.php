<?php

namespace Karvaka\Wired\Table;

use Illuminate\Support\Str;

final class Utils
{
    public static function humanize($attribute): string
    {
        return (is_object($attribute) ? Str::of(class_basename($attribute)) : Str::of($attribute))
            ->snake()->replace(['_', '-', '.'], ' ')->title();
    }
}
