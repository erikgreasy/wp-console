<?php

namespace Erikgreasy\WpConsole;

use Symfony\Component\Console\Application;
use Erikgreasy\WpConsole\Commands\MakeCommand;

class ConsoleApplication extends Application
{
    public function __construct(string $projectCommandsFolderPath)
    {
        parent::__construct();

        $this->add(
            new MakeCommand()
        );

        $this->autoloadProjectCommands($projectCommandsFolderPath);

        $this->run();
    }

    /**
     * Automatically load commands in specified folder, scanning first level PHP files.
     * This way, there is no need to manually add all commands via add() func.
     */
    private function autoloadProjectCommands(string $projectCommandsFolderPath): void
    {
        $commandFiles = glob($projectCommandsFolderPath . '/*.php');

        foreach ($commandFiles as $file) {
            $shortFileName = basename($file);
            $className = str_replace('.php', '', $shortFileName);

            $fullClassName = "\\PixelConsole\\{$className}";

            $this->add(
                new $fullClassName()
            );
        }
    }
}
