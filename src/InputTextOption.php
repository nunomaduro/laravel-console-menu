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

/**
 * This is an Laravel Console Menu Option implementation.
 */
class InputTextOption implements SelectedOption
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
     * @param int|string $value
     */
    public function __construct($value)
    {
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
