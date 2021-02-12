<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Link extends Column
{
    public string $component = 'wired-table::columns.link';

    public function getLink(Model $model)
    {
        return $this->getValue($model);
    }

    public function renderCell(Model $model)
    {
        return view($this->component, [
            'model' => $model,
            'link' => $this->getLink($model),
            'value' => $this->getValue($model)
        ]);
    }
}
