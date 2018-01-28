<?php

declare(strict_types=1);

/**
 * This file is part of Laravel Console Menu.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace NunoMaduro\LaravelConsoleMenu;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;

/**
 * This is an Laravel Console Menu Service Provider implementation.
 */
class LaravelConsoleMenuServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        /*
         * Returns a menu builder.
         *
         * @param  string $title
         * @param  array $options
         *
         * @return \NunoMaduro\LaravelConsoleMenu\Menu
         */
        Command::macro(
            'menu',
            function (string $title = '', array $options = []) {
                return new Menu($title, $options);
            }
        );
    }
}
