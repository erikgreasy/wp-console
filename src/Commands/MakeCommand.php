<?php

namespace Erikgreasy\WpConsole\Commands;

use Erikgreasy\WpConsole\ConsoleApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'make:command')]
class MakeCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stubContent = file_get_contents(__DIR__ . '/../../stubs/Command.stub');

        $commandName = $input->getArgument('command_name');

        $newCommand = str_replace('{{command_name}}', $commandName, $stubContent);

        file_put_contents("commands/{$commandName}.php", $newCommand);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('command_name', InputArgument::REQUIRED, 'Enter the name of the command.');
    }
}
