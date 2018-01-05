<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\Components\BaseGrid;

use Dravencms\Components\BaseGrid\Column\ColumnBoolean;
use Ublaboo\DataGrid\DataGrid;

class Grid extends DataGrid
{
    /**
     * @param $key
     * @param $column
     * @param $name
     * @return Boolean
     */
    public function addColumnBoolean($key, $column, $name = null)
    {
        return $this->addColumn($key, new ColumnBoolean($this, $key, $column, $name));
    }
}