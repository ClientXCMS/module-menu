<?php

namespace App\Menu;

use ClientX\Renderer\RendererInterface;
use ClientX\Validator;

class MenuSetting implements \App\Admin\Settings\SettingsInterface
{

    public function name(): string
    {
        return 'menu';
    }

    public function title(): string
    {
        return "Menu";
    }

    public function icon(): string
    {
        return "fas fa-compass";
    }

    public function render(RendererInterface $renderer)
    {
        return $renderer->render("@menu_admin/settings");
    }

    public function validate(array $params): Validator
    {
        return (new Validator($params))
                ->notEmpty('menu_title');
    }
}