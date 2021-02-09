<?php

namespace Karvaka\Wired\Table;

use Illuminate\Support\Str;

final class Utils
{
    public static function humanize($attribute): string
    {
        return Str::of($attribute)->snake()->replace(['_', '-', '.'], ' ')->ucfirst();
    }
}
