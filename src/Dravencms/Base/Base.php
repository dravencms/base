<?php

namespace Dravencms\Base;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class Base
{
    public $templateSearchPaths = [];

    public function addTemplateSearchPath($name, $path)
    {
        $this->templateSearchPaths[$name] = $path;
    }

    public function addTemplateProvider(ITemplate $template)
    {
        $this->addTemplateSearchPath($template->getName(), $template->getPath());
    }

    public function getTemplateSearchPaths()
    {
        return $this->templateSearchPaths;
    }

    public function findTemplate($name)
    {
        if (array_key_exists($name, $this->templateSearchPaths))
        {
            return $this->templateSearchPaths[$name];
        }

        return null;
    }
}