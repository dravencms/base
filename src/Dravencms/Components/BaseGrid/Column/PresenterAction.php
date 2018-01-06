<?php
/**
 * Created by PhpStorm.
 * User: sadam
 * Date: 1/6/18
 * Time: 3:30 AM
 */

namespace Dravencms\Components\BaseGrid\Column;


use Nette\Application\UI\InvalidLinkException;
use Ublaboo\DataGrid\Column\Action;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridHasToBeAttachedToPresenterComponentException;

class PresenterAction extends Action
{
    /**
     * Create link to custom destination
     * @param  DataGrid $grid
     * @param  string   $href
     * @param  array    $params
     * @return string
     * @throws DataGridHasToBeAttachedToPresenterComponentException
     * @throws \InvalidArgumentException
     */
    protected function createLink(DataGrid $grid, $href, $params)
    {
        try {
            $parent = $grid->getParent();

            return $parent->link($href, $params);
        } catch (DataGridHasToBeAttachedToPresenterComponentException $e) {
            $parent = $grid->getPresenter();

        } catch (\InvalidArgumentException $e) {
            $parent = $grid->getPresenter();
        } catch (InvalidLinkException $e) {
            $parent = $grid->getPresenter();
        }

        return $parent->link($href, $params);
    }
}