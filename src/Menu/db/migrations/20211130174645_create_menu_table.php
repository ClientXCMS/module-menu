<?php

use Phinx\Migration\AbstractMigration;

class CreateMenuTable extends AbstractMigration
{
    public function change()
    {
        $this->table("menus")
            ->addColumn("title", "string")
            ->addColumn("redirect", "string")
            ->addColumn("icon", "string")
            ->addColumn("user", 'string')
            ->addColumn("blank", "boolean")
            ->addColumn("position", "integer")
            ->addColumn("badge", "string", ['null' => true])
            ->create();
    }
}
