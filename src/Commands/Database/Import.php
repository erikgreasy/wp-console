<?php

namespace Erikgreasy\WpConsole\Commands\Database;

use mysqli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

#[AsCommand(name: 'db:import')]
class Import extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Following command will overwrite your current database. Do you want to proceed? [y/n]: ', false);

        if (!$helper->ask($input, $output, $question)) {
            $output->writeln('<error>Import aborted</error>');
            return Command::SUCCESS;
        }

        $filename = $input->getArgument('filename');

        $sqlFile = file_get_contents($filename);

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $mysqli->multi_query($sqlFile);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument('filename', InputArgument::REQUIRED, 'Enter the filename you want to import');
    }
}
