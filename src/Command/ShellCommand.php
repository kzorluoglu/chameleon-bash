<?php

namespace kzorluoglu\ChameleonBash\Command;

use Psy\Configuration;
use Psy\Shell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShellCommand extends Command
{

    protected static $defaultName = 'chameleon_system:shell';
    protected array $commandWhitelist = [];


    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getApplication()->setCatchExceptions(false);

        $config = new Configuration([
            'startupMessage' => sprintf('<info>%s</info> %s', 'Chameleon System Shell v0.1.1', 'Hello'),
        ]);
        $shell = new Shell($config);


        $shell->addCommands($this->getCommands());

        return $shell->run();
    }

    protected function getCommands()
    {
        $commands = [];

        foreach ($this->getApplication()->all() as $name => $command) {
            if (in_array($name, $this->commandWhitelist, true)) {
                $commands[] = $command;
            }
        }

        return $commands;
    }
}
