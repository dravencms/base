<?php

namespace Dravencms\Base\Command;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Kdyby\Doctrine\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */
class DefaultDataCommand extends Command
{
    /** @var EntityManager @inject */
    public $em;


    protected function configure()
    {
        $this->setName('fix:a')
            ->setDescription('Load data fixtures to your database.');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $loader = new Loader();
            $loader->loadFromDirectory(__DIR__ . '/../../../../../../dravencms'); //!FIXME rewrite this into factory and use DI to find all registered fixtures
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