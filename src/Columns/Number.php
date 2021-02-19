<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Number extends Column
{
    private ?int $decimals = null;
    private ?string $decimalSeparator = null;
    private ?string $thousandsSeparator = null;

    protected static int $defaultDecimals = 2;
    protected static string $defaultDecimalSeparator = '.';
    protected static string $defaultThousandsSeparator = ',';

    protected function init(): void
    {
        $this->alignRight();
    }

    public function decimals(?int $decimals): self
    {
        $this->decimals = $decimals;

        return $this;
    }

    public static function setDefaultDecimals(int $decimals): void
    {
        static::$defaultDecimals = $decimals;
    }

    public function getDecimals(): int
    {
        return $this->decimals ?? static::$defaultDecimals;
    }

    public function decimalSeparator(?string $separator): self
    {
        $this->decimalSeparator = $separator;

        return $this;
    }

    public static function setDefaultDecimalSeparator(string $separator): void
    {
        static::$defaultDecimalSeparator = $separator;
    }

    public function getDecimalsSeparator(): string
    {
        return $this->decimalSeparator ?? static::$defaultDecimalSeparator;
    }

    public function thousandsSeparator(?string $separator): self
    {
        $this->thousandsSeparator = $separator;

        return $this;
    }

    public static function setDefaultThousandsSeparator(string $separator): void
    {
        static::$defaultThousandsSeparator = $separator;
    }

    public function getThousandsSeparator(): string
    {
        return $this->thousandsSeparator ?? static::$defaultThousandsSeparator;
    }

    public function getValue(Model $model)
    {
        $value = parent::getValue($model);

        return number_format($value, $this->getDecimals(), $this->getDecimalsSeparator(), $this->getThousandsSeparator());
    }
}
