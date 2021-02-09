<?php

namespace Karvaka\Wired\Table\Formatters;

class EmailFormatter extends LinkFormatter
{
    public function getHref(): string
    {
        return 'mailto:' . $this->getValue();
    }
}
