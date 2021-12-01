<?php

namespace App\Menu;

use App\Menu\Actions\MenuCrudAction;
use App\Menu\Actions\MenuSwitchAction;
use ClientX\Module;
use ClientX\Renderer\RendererInterface;
use ClientX\Router;
use Psr\Container\ContainerInterface;

class MenuModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';
    const MIGRATIONS = __DIR__ . '/db/migrations';

    const TRANSLATIONS = [
        "fr_FR" => __DIR__ . "/trans/fr.php",
        "en_GB" => __DIR__ . "/trans/en.php"
    ];

    public function __construct(RendererInterface $renderer, ContainerInterface $container)
    {
        if ($container->has('admin.prefix')) {
            $renderer->addPath("menu_admin", __DIR__ . '/views');
            /** @var Router $router */
            $router = $container->get(Router::class);
            $prefix = $container->get('admin.prefix');
            $router->crud($prefix . '/menus', MenuCrudAction::class, 'menu.admin');
            $router->post($prefix . '/menus/switch', MenuSwitchAction::class, 'menu.admin.switch');
        }
    }
}
