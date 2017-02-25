<?php

namespace Dravencms\Components\BaseForm;

use Dravencms\Components\BaseControl\BaseControl;
use Nette\Forms\IFormRenderer;
use Nette\Localization\ITranslator;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class BaseForm extends BaseControl implements BaseFormFactory
{
    /** @var IFormRenderer */
    private $renderer;

    /** @var ITranslator */
    private $translator;

    /**
     * BaseForm constructor.
     * @param IFormRenderer|null $renderer
     * @param ITranslator|null $translator
     */
    public function __construct( IFormRenderer $renderer = null, ITranslator $translator = null)
    {
        $this->renderer = $renderer;
        $this->translator = $translator;

        parent::__construct();
    }
    
    /**
     * @return Form
     */
    public function create()
    {
        $form = new Form();
        $form->setRenderer($this->renderer);
        $form->setTranslator($this->translator);
        $form->addProtection('Please, send form again.');

        return $form;
    }

}