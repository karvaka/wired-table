<?php

namespace Karvaka\Wired\Table\Formatters;

class DateFormatter extends Formatter
{
    public string $format = 'Y-m-d';

    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getValue()
    {
        // TODO safe check
        return parent::getValue()->format($this->format);
    }
}
