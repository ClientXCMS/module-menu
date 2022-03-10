<?php
namespace App\Menu\Database;

use ClientX\Database\Table;
use ClientX\Database\Query;

class MenuTable extends Table
{
    protected $table = "menus";
    protected $order = "position DESC";

    public function insert(array $params): int
    {

        $params['badge'] = empty($params['badge']) ? null : $params['badge'];
        $params['blank'] = (int)array_key_exists('blank', $params);
        $params['position'] = 0;
        return parent::insert($params);
    }

    public function update($condition, $params, $where = 'id'): bool
    {
        $params['blank'] = (int)array_key_exists('blank', $params);
        $params['badge'] = empty($params['badge']) ? null : $params['badge'];
        return parent::update($condition, $params, $where);
    }

    public function update2(string $id, $params)
    {
        return parent::update($id, $params, 'id');
    }

    public function makeQueryForAdmin(?array $search = null, $order = "desc"): Query
    {
        $query = parent::makeQueryForAdmin($search);
        $query->order = [];
        $query->order($this->order);
        return $query;
    }
}
