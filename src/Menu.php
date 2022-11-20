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

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use PhpSchool\CliMenu\CliMenu;

/**
 * This is an Laravel Console Menu implementation.
 */
class Menu extends CliMenuBuilder
{
    /**
     * The current option value.
     *
     * @var mixed
     */
    private $result;

    /**
     * Menu constructor.
     *
     * @param  string  $title
     * @param  array  $options
     */
    public function __construct($title = '', array $options = [])
    {
        parent::__construct();

        $this->addLineBreak(' ')
            ->setTitleSeparator('-');

        $this->setMarginAuto();

        $this->setTitle($title);

        $this->addOptions($options);
    }

    /**
     * Adds a new option.
     *
     * @param mixed $value
     * @param string $label
     * @param CliMenuBuilder|null $subMenu
     *
     * @return \NunoMaduro\LaravelConsoleMenu\Menu
     */
    public function addOption($value, string $label, ?CliMenuBuilder $subMenu = null): Menu
    {
        $menu = $subMenu ?? $this;
        $menu->addMenuItem(
            new MenuOption(
                $value,
                $label,
                function (CliMenu $menu) {
                    $this->result = $menu->getSelectedItem()->getValue();
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
     * @param CliMenuBuilder|null $subMenu
     *
     * @return \NunoMaduro\LaravelConsoleMenu\Menu
     */
    public function addOptions(array $options, ?CliMenuBuilder $subMenu = null): Menu
    {
        foreach ($options as $value => $label) {
            if (is_array($label)) {
                $subMenuOptions = $label;
                $menu = $this;
                $this->addSubMenu($value, function (CliMenuBuilder $subMenu) use ($value, $subMenuOptions, $menu) {
                    $subMenu->setTitle($value);
                    $menu->addOptions($subMenuOptions, $subMenu);
                });
            } else {
                $this->addOption($value, $label, $subMenu);
            }
        }

        return $this;
    }

    /**
     * Add a question.
     *
     * @param  string  $label
     * @param  string  $placeholder
     * @return \NunoMaduro\LaravelConsoleMenu\Menu
     */
    public function addQuestion(string $label, string $placeholder = ''): Menu
    {
        $itemCallable = function (CliMenu $menu) use ($label, $placeholder) {
            $result = $menu->askText()
                ->setPromptText($label)
                ->setPlaceholderText($placeholder)
                ->ask();

            $this->result = $result->fetch();

            $menu->close();
        };

        $this->addItem($label, $itemCallable);

        return $this;
    }

    /**
     * Open the menu and return the result.
     *
     * @return mixed
     */
    public function open()
    {
        $this->build()
            ->open();

        return $this->result;
    }

    /**
     * Set the result.
     *
     * @param  mixed  $result
     * @return \NunoMaduro\LaravelConsoleMenu\Menu
     */
    public function setResult($result): Menu
    {
        $this->result = $result;

        return $this;
    }
}
