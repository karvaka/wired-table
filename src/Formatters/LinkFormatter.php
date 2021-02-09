<?php

namespace Karvaka\Wired\Table\Formatters;

use Illuminate\Database\Eloquent\Model;
use Karvaka\Wired\Table\Columns\Link;

class LinkFormatter extends Formatter
{
    public function __construct(Link $column, Model $model)
    {
        parent::__construct($column, $model);
    }

    public function getHref(): string
    {
        return $this->getValue();
    }
}
