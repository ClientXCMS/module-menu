<?php

use App\Menu\MenuAdminItem;
use function DI\add;
use function DI\get;

return [
    'admin.menu.items' => add([get(MenuAdminItem::class)]),
    'navigation.main.items' => add(get(\App\Menu\MenuMainItem::class)),
    'csrf.except' => add('menu.admin.switch'),
];