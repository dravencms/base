<?php

namespace Dravencms\Base\Console;

use Dravencms\Base\Base;
use Symfony\Component\Console\Command\Command;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Kdyby\Doctrine\EntityManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class DefaultDataCommand extends Command
{
    /** @var EntityManager @inject */
    public $em;

    /** @var Base @inject */
    public $base;

    protected function configure()
    {
        $this->setName('orm:default-data:load')
            ->setDescription('Load data fixtures to your database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $loader = new Loader();
            foreach ($this->base->getFixtures() as $fixture)
            {
                $loader->addFixture($fixture);
            }

            $fixtures = $loader->getFixtures();
            $purger = new ORMPurger($this->em);
            $executor = new ORMExecutor($this->em, $purger);
            $executor->setLogger(function ($message) use ($output) {
                $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', $message));
            });
            $executor->execute($fixtures);
            return 0; // zero return code means everything is ok
        } catch (\Exception $exc) {
            $output->writeLn("<error>{$exc->getMessage()}</error>");
            return 1; // non-zero return code means error
        }
    }
}