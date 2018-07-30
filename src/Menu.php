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

use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\Builder\CliMenuBuilder;

/**
 * This is an Laravel Console Menu implementation.
 */
class Menu extends CliMenuBuilder
{
    /**
     * The current option selected, if any.
     *
     * @var \NunoMaduro\LaravelConsoleMenu\SelectedOption
     */
    private $optionSelected;

    /**
     * Menu constructor.
     *
     * @param string $title
     * @param array $options
     */
    public function __construct($title = '', array $options = [])
    {
        parent::__construct();

        $this->addLineBreak(' ')
            ->setTitleSeparator('-');

        $this->setTitle($title);

        $this->addOptions($options);
    }

    /**
     * Adds a new option.
     *
     * @param mixed $value
     * @param string $label
     *
     * @return \NunoMaduro\LaravelConsoleMenu\Menu
     */
    public function addOption($value, string $label): Menu
    {
        $this->addMenuItem(
            new MenuOption(
                $value, $label, function (CliMenu $menu) {
                    $this->optionSelected = $menu->getSelectedItem();
                    $menu->close();
                }
            )
        );

        return $this;
    }

    /**
     * Adds multiple options.
     *
     * @param array $options
     *
     * @return \NunoMaduro\LaravelConsoleMenu\Menu
     */
    public function addOptions(array $options): Menu
    {
        foreach ($options as $value => $label) {
            $this->addOption($value, $label);
        }

        return $this;
    }

    /**
     * Adds a new text input option.
     *
     * @param string $label
     * @param string $promptText
     * @param string $placeholder
     * @return Menu
     */
    public function addTextInputOption(string $label, string $promptText, string $placeholder = 'Enter text...' ): Menu
    {
        $itemCallable = function (CliMenu $menu) use ($promptText, $placeholder) {
            $result = $menu->askText()
                ->setPromptText($promptText)
                ->setPlaceholderText($placeholder)
                ->ask();

            $this->optionSelected = new InputTextOption($result->fetch());

            $menu->close();
        };

        $this->addItem($label, $itemCallable);

        return $this;
    }

    /**
     * Opens the menu and returns the selected option value.
     *
     * @return mixed
     */
    public function open()
    {
        $this->build()
            ->open();

        return $this->optionSelected ? $this->optionSelected->getValue() : null;
    }
}
