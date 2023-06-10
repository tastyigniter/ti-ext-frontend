<?php

namespace Igniter\Frontend\Models;

class Menu extends \Igniter\Cart\Models\Menu
{
    public static function getByIds($options = [])
    {
        extract(array_merge([
            'pageLimit' => 20,
            'sort' => 'menu_priority asc',
            'menuIds' => [],
        ], $options));

        if (!is_array($menuIds)) {
            $menuIds = [$menuIds];
        }

        $query = self::whereIn('menu_id', $menuIds);

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            $parts = explode(' ', $_sort);
            if (count($parts) < 2) {
                array_push($parts, 'desc');
            }
            [$sortField, $sortDirection] = $parts;
            $query->orderBy($sortField, $sortDirection);
        }

        return $query->whereIsEnabled()->take($pageLimit)->get();
    }
}
