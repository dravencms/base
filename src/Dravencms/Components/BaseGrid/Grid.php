<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\Components\BaseGrid;

use Dravencms\Components\BaseGrid\Column\ColumnBoolean;
use Dravencms\Components\BaseGrid\Column\ColumnPosition;
use Dravencms\Components\BaseGrid\Column\PresenterAction;
use Nette\Utils\Html;
use Ublaboo\DataGrid\DataGrid;

class Grid extends DataGrid
{
    /**
     * @param $key
     * @param $name
     * @param null $column
     * @return \Ublaboo\DataGrid\Column\Column
     * @throws \Ublaboo\DataGrid\Exception\DataGridException
     */
    public function addColumnBoolean($key, $name, $column = null)
    {
        $this->addColumnCheck($key);
        $column = $column ?: $key;
        return $this->addColumn($key, new ColumnBoolean($this, $key, $column, $name));
    }

    /**
     * @param $key
     * @param $name
     * @param string $upHref
     * @param string $downHref
     * @param null $column
     * @return \Ublaboo\DataGrid\Column\Column
     * @throws \Ublaboo\DataGrid\Exception\DataGridException
     */
    public function addColumnPosition($key, $name, $upHref = 'up!', $downHref = 'down!', $column = null)
    {
        $this->addColumnCheck($key);
        $column = $column ?: $key;
        return $this->addColumn($key, new ColumnPosition($this, $key, $column, $name, $upHref, $downHref));
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
