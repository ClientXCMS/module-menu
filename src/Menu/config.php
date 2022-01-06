<?php

use App\Menu\MenuAdminItem;
use function ClientX\setting;
use function DI\add;
use function DI\get;

return [
    'admin.menu.items' => add([get(MenuAdminItem::class)]),
    'navigation.main.items' => add(get(\App\Menu\MenuMainItem::class)),
    'csrf.except' => add('menu.admin.switch'),
    \App\Menu\MenuMainItem::class => \DI\autowire()->constructorParameter('title', setting('menu_title', 'Main menu')),
    'admin.settings' => add(get(\App\Menu\MenuSetting::class)),
];