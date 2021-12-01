<?php

namespace App\Menu;

use ClientX\Renderer\RendererInterface;

class MenuAdminItem implements \ClientX\Navigation\NavigationItemInterface
{

    /**
     * @inheritDoc
     */
    public function getPosition(): int
    {
        return 10;
    }

    /**
     * @inheritDoc
     */
    public function render(RendererInterface $renderer): string
    {
        return $renderer->render('@menu_admin/menu');
    }
}