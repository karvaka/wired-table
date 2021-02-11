<?php

namespace Karvaka\Wired\Table;

use Illuminate\Support\Str;

final class Utils
{
    public static function humanize($attribute): string
    {
        return Str::of((is_object($attribute) ? class_basename($attribute) : $attribute))
            ->snake()->replace(['_', '-', '.'], ' ')->title();
    }
}
