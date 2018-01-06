<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Dravencms\FrontModule;

use Nette\Application\UI\Presenter;

class BasePresenter extends \Dravencms\BasePresenter
{
    public function startup()
    {
        $this->getUser()->getStorage()->setNamespace('Front');
        parent::startup();
    }
}