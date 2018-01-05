<?php

namespace Dravencms\Components\BaseGrid\Column;

use Nette\Utils\Html;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\Row;

class ColumnBoolean extends Column
{
    /**
     * @var string
     */
    protected $align = 'center';

    /**
     * Format row item value
     * @param  Row   $row
     * @return mixed
     */
    public function getColumnValue(Row $row)
    {
        $value = parent::getColumnValue($row);

        $icon = $value ? 'ok' : 'remove';
        return Html::el('i')->class("glyphicon glyphicon-$icon icon-$icon");
    }
}
