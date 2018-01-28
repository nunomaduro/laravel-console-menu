<p align="center">
    <img src="docs/example.png" width="100%">
</p>

<p align="center">
  <a href="https://styleci.io/repos/119292066"><img src="https://styleci.io/repos/119292066/shield" alt="StyleCI Status"></img></a>
  <a href="https://scrutinizer-ci.com/g/nunomaduro/laravel-console-menu"><img src="https://img.shields.io/scrutinizer/g/nunomaduro/laravel-console-menu.svg" alt="Quality Score"></img></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-menu"><img src="https://poser.pugx.org/nunomaduro/laravel-console-menu/d/total.svg" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-menu"><img src="https://poser.pugx.org/nunomaduro/laravel-console-menu/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-menu"><img src="https://poser.pugx.org/nunomaduro/laravel-console-menu/license.svg" alt="License"></a>
</p>

## About Laravel Console Menu

Laravel Console Menu was created by, and is maintained by [Nuno Maduro](https://github.com/nunomaduro), and is output method for Laravel Console Commands.

## Installation

> **Requires [PHP 7.0+](https://php.net/releases/)**

Require Laravel Console Menu using [Composer](https://getcomposer.org):

```bash
composer require nunomaduro/laravel-console-menu
```

## Usage

```php
class MenuCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $option = $this->menu('Pizza menu', [
            'Freshly baked muffins',
            'Freshly baked croissants',
            'Turnovers, crumb cake, cinnamon buns, scones',
        ])->open();

        $this->info("You have chosen the option number #$option");
    }
}
```

## Contributing

Thank you for considering to contribute to Laravel Console Menu. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

You can have a look at the [CHANGELOG](CHANGELOG.md) for constant updates & detailed information about the changes. You can also follow the twitter account for latest announcements or just come say hi!: [@enunomaduro](https://twitter.com/enunomaduro)

## License

Laravel Console Menu is an open-sourced software licensed under the [MIT license](LICENSE.md).
