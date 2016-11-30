<?php

namespace Dravencms\Base\DI;

use Kdyby\Console\DI\ConsoleExtension;
use Nette;
use Nette\DI\Compiler;
use Nette\DI\Configurator;

/**
 * Class BaseExtension
 * @package Dravencms\Structure\DI
 */
class BaseExtension extends Nette\DI\CompilerExtension
{

    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();


        $builder->addDefinition($this->prefix('base'))
            ->setClass('Dravencms\Base\Base', []);

        $this->loadComponents();
        $this->loadModels();
        $this->loadConsole();
    }

    public function beforeCompile()
    {
        $builder = $this->getContainerBuilder();
        $cms = $builder->getDefinition($this->prefix('base'));


        foreach ($builder->findByType('Dravencms\Base\ITemplate') AS $serviceName => $service) {
                $cms->addSetup('addTemplateProvider', ['@' . $serviceName]);
        }

        foreach ($builder->findByType('Doctrine\Common\DataFixtures\SharedFixtureInterface') AS $serviceName => $service) {
            $cms->addSetup('addFixtureProvider', ['@' . $serviceName, $serviceName]);
        }
    }

    /**
     * @param Configurator $config
     * @param string $extensionName
     */
    public static function register(Configurator $config, $extensionName = 'structureExtension')
    {
        $config->onCompile[] = function (Configurator $config, Compiler $compiler) use ($extensionName) {
            $compiler->addExtension($extensionName, new StructureExtension());
        };
    }


    /**
     * {@inheritdoc}
     */
    public function getConfig(array $defaults = [], $expand = true)
    {
        $defaults = [
        ];

        return parent::getConfig($defaults, $expand);
    }

    protected function loadComponents()
    {
        $builder = $this->getContainerBuilder();
        foreach ($this->loadFromFile(__DIR__ . '/components.neon') as $i => $command) {
            $cli = $builder->addDefinition($this->prefix('components.' . $i))
                ->setInject(FALSE); // lazy injects
            if (is_string($command)) {
                $cli->setImplement($command);
            } else {
                throw new \InvalidArgumentException;
            }
        }
    }

    protected function loadModels()
    {
        $builder = $this->getContainerBuilder();
        foreach ($this->loadFromFile(__DIR__ . '/models.neon') as $i => $command) {
            $cli = $builder->addDefinition($this->prefix('models.' . $i))
                ->setInject(FALSE); // lazy injects
            if (is_string($command)) {
                $cli->setClass($command);
            } else {
                throw new \InvalidArgumentException;
            }
        }
    }

    protected function loadConsole()
    {
        $builder = $this->getContainerBuilder();

        foreach ($this->loadFromFile(__DIR__ . '/console.neon') as $i => $command) {
            $cli = $builder->addDefinition($this->prefix('cli.' . $i))
                ->addTag(ConsoleExtension::TAG_COMMAND)
                ->setInject(FALSE); // lazy injects

            if (is_string($command)) {
                $cli->setClass($command);

            } else {
                throw new \InvalidArgumentException;
            }
        }
    }
}
