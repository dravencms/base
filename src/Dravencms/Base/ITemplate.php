<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\Base;


use Nette\Application\IPresenter;

interface ITemplate
{
    public function getPath();

    public function getName();

    public function getMenuConfig(IPresenter $presenter);
}