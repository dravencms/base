<?php

namespace Dravencms\Components\BaseGrid\Column;

use Nette\Utils\Html;
use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridColumnRendererException;
use Ublaboo\DataGrid\Row;

class ColumnPosition extends Column
{
    /**
     * @var string
     */
    protected $align = 'center';

    protected $upHref;

    protected $downHref;

    protected $column;

    public function __construct(DataGrid $grid, $key, $column, $name, $upHref, $downHref)
    {
        $this->upHref = $upHref;
        $this->downHref = $downHref;
        $this->column = $column;

        parent::__construct($grid, $key, $column, $name);
    }

    /**
     * Render row item into template
     * @param  Row   $row
     * @return mixed
     */
    public function render(Row $row)
    {
        /**
         * Renderer function may be used
         */
        try {
            return $this->useRenderer($row);
        } catch (DataGridColumnRendererException $e) {
            /**
             * Do not use renderer
             */
        }

        $container = Html::el('div', ['class' => 'btn-group']);

        $elDown = Html::el('a', ['class' => 'btn btn-xs']);
        $elDown->href($this->createLink($this->grid, $this->downHref, $this->getItemParams($row, ['id'])));
        $elDown->setHtml('<i class="fa fa-chevron-down" aria-hidden="true"></i>');
        $container->addHtml($elDown);

        $elUp = Html::el('a', ['class' => 'btn btn-xs']);
        $elUp->href($this->createLink($this->grid, $this->upHref, $this->getItemParams($row, ['id'])));
        $elUp->setHtml('<i class="fa fa-chevron-up" aria-hidden="true"></i>');

        $container->addHtml($elUp);

        return $container;
    }
}
