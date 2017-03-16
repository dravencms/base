<?php

namespace Dravencms\Base;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class Base
{
    private $templateProviders = [];

    public $fixtures = [];

    public function addTemplateProvider(ITemplate $template)
    {
        $this->templateProviders[$template->getName()] = $template;
    }

    /**
     * @param $name
     * @return ITemplate|null
     */
    public function findTemplate($name)
    {
        if (array_key_exists($name, $this->templateProviders))
        {
            return $this->templateProviders[$name];
        }

        return null;
    }

    public function addFixtureProvider($class, $name)
    {
        $this->fixtures[$name] = $class;
    }

    public function getFixtures()
    {
        return $this->fixtures;
    }

}