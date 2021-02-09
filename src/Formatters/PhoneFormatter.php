<?php

namespace Karvaka\Wired\Table\Formatters;

class PhoneFormatter extends LinkFormatter
{
    public function getHref(): string
    {
        return 'tel:' . $this->getValue();
    }
}
