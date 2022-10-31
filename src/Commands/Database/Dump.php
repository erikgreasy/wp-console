<?php

namespace Erikgreasy\WpConsole\Commands\Database;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'db:dump')]
class Dump extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Enter your command code here

        $host = DB_HOST;
        $name = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASSWORD;

        $dumpFilename = date('Y-m-d_H-i-s') . "_{$name}.sql";

        if(!file_exists('backups')) {
            mkdir('backups');
        }

        try {
            $dump = new \Druidfi\Mysqldump\Mysqldump("mysql:host={$host};dbname={$name}", $user, $pass, [
                'add-drop-table' => true
            ]);
            $dump->start('backups/' . $dumpFilename);
        } catch (\Exception $e) {
            echo 'mysqldump-php error: ' . $e->getMessage();
        }

        return Command::SUCCESS;
    }
}
