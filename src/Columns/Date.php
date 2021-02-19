<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Date extends Column
{
    private ?string $format = null;
    protected static string $defaultFormat = 'Y-m-d';

    public function format(?string $format = null): self
    {
        $this->format = $format;

        return $this;
    }

    public static function setDefaultFormat(string $format): void
    {
        static::$defaultFormat = $format;
    }

    public function getFormat(): string
    {
        return $this->format ?? static::$defaultFormat;
    }

    public function getValue(Model $model)
    {
        $value = parent::getValue($model);

        return $value instanceof \DateTimeInterface ? $value->format($this->getFormat()) : null;
    }
}
