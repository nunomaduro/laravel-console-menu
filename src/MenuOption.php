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

use PhpSchool\CliMenu\MenuItem\SelectableItem;

/**
 * This is a Laravel Console Menu Option implementation.
 */
class MenuOption extends SelectableItem
{
    /**
     * The option value.
     *
     * @var mixed
     */
    private $value;

    /**
     * Creates a new menu option.
     *
     * @param  int|string  $value
     * @param  string  $text
     * @param  bool  $showItemExtra
     * @param  bool  $disabled
     */
    public function __construct($value, $text, callable $callback, $showItemExtra = false, $disabled = false)
    {
        parent::__construct($text, $callback, $showItemExtra, $disabled);

        $this->value = $value;
    }

    /**
     * Returns the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
