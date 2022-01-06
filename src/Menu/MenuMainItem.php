<?php

namespace App\Menu;

use App\Menu\Database\MenuTable;
use ClientX\Navigation\DefaultItem;
use ClientX\Navigation\DefaultMainItem;
use ClientX\Navigation\NavigationItemInterface;
use ClientX\Renderer\RendererInterface;

class MenuMainItem implements NavigationItemInterface
{
    private MenuTable $table;
    private string $title;

    public function __construct(MenuTable $table, string $title)
    {
        $this->table = $table;
        $this->title = $title;
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): int
    {
        return 100;
    }

    /**
     * @inheritDoc
     */
    public function render(RendererInterface $renderer): string
    {
        $records = $this->table->findAll()->group("GROUP BY user")->order("position DESC")->fetchAll();
        $online = $this->filter($records, 'online');
        $offline = $this->filter($records, 'offline');
        $global = $this->filter($records, 'global');
        $title = $this->title;
        return $renderer->render(DefaultItem::MAIN_MENU, compact('global', 'offline', 'online', 'title'));
    }

    private function filter($records, string $user)
    {
        return collect($records)->filter(function ($record) use ($user) {
            return $record->user === $user;
        })->map(fn($record) => DefaultMainItem::makeItem($record->title, $record->redirect, $record->icon, $user == 'offline', $user === 'online', $record->badge))->toArray();
    }
}
