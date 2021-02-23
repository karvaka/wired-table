<?php

namespace Karvaka\Wired\Table\Columns;

use Illuminate\Database\Eloquent\Model;

class Link extends Column
{
    protected string $defaultComponent = 'wired-table::cells.link';

    public function getLink(Model $model)
    {
        return $this->getValue($model);
    }

    public function renderCell(Model $model)
    {
        return view($this->getComponent(), [
            'model' => $model,
            'link' => $this->getLink($model),
            'value' => $this->getValue($model)
        ]);
    }
}
