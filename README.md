# WordPress Console
CLI application inspired by artisan in Laravel framework. Based on the Symfony console component.

## Instantiating in project
create "cli" (alernative to artisan) file in the root of your project
```PHP
#!/usr/bin/env php
<?php

use Erikgreasy\WpConsole\ConsoleApplication;

require __DIR__ . '/vendor/autoload.php';

// load WordPress so we can use WP functions in commands
require __DIR__ . '/web/wp/wp-load.php';

new ConsoleApplication(__DIR__ . '/commands');

```

Create directory for commands
```
mkdir commands
```

## Creating commands
To be able to create new commands, you need to instantiate the CLI in your project, following the steps higher.
```
php cli make:command CommandName
```
For more information about commands, refer to [Symfony console docs](https://symfony.com/doc/current/components/console.html).
