<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\Components\BaseGrid;

use Dravencms\Components\BaseGrid\Column\ColumnBoolean;
use Dravencms\Components\BaseGrid\Column\PresenterAction;
use Ublaboo\DataGrid\DataGrid;

class Grid extends DataGrid
{
    /**
     * @param $key
     * @param $column
     * @param $name
     * @return Boolean
     */
    public function addColumnBoolean($key, $name, $column = null)
    {
        $this->addColumnCheck($key);
        $column = $column ?: $key;
        return $this->addColumn($key, new ColumnBoolean($this, $key, $column, $name));
    }

    /**
     * @param string $key
     * @param string $name
     * @param null $href
     * @param array|null $params
     * @return PresenterAction
     * @throws \Ublaboo\DataGrid\Exception\DataGridException
     */
    public function addAction($key, $name, $href = null, array $params = null)
    {
        $this->addActionCheck($key);

        $href = $href ?: $key;

        if ($params === null) {
            $params = [$this->primary_key];
        }

        return $this->actions[$key] = new PresenterAction($this, $href, $name, $params);
    }
}