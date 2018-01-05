<?php

namespace Dravencms\Components\BaseGrid\Columns;
use Nette\Utils\Html;
use Ublaboo\DataGrid\Column\ColumnText;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class Boolean extends ColumnText
{
    /*public function getCellPrototype($row = NULL)
    {
        $cell = parent::getCellPrototype($row = NULL);
        $cell->class[] = 'center';
        return $cell;
    }*/
    
  
    /**
     * @param $value
     * @return Html
     */
    protected function formatValue($value)
    {
        $icon = $value ? 'ok' : 'remove';
        return Html::el('i')->class("glyphicon glyphicon-$icon icon-$icon");
    }
}