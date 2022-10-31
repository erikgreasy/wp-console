<?php

namespace Erikgreasy\WpConsole;

use Symfony\Component\Console\Application;
use Erikgreasy\WpConsole\Commands\MakeCommand;

class ConsoleApplication
{
    public function __construct(string $projectCommandsFolderPath, string $namespace = "PixelConsole")
    {
        $application = new Application();

        $application->add(
            new MakeCommand()
        );

        $commandFiles = glob($projectCommandsFolderPath . '/*.php');

        foreach ($commandFiles as $file) {
            $shortFileName = basename($file);
            $className = str_replace('.php', '', $shortFileName);

            $fullClassName = "\\{$namespace}\\{$className}";

            $application->add(
                new $fullClassName()
            );
        }

        $application->run();
    }
}
