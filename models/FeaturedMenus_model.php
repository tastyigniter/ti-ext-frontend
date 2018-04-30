<?php namespace SamPoyigi\Featured_menus\Models;

class FeaturedMenus_model extends \Admin\Models\Menus_model
{
    public static function getByIds($options = [])
    {
        extract(array_merge([
            'pageLimit' => 20,
            'sort'      => 'menu_priority asc',
            'menu_ids'  => [],
        ], $options));

        if (!is_array($menu_ids)) {
            $menu_ids = [$menu_ids];
        }

        $query = self::whereIn('menu_id', $menu_ids);

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            $parts = explode(' ', $_sort);
            if (count($parts) < 2) {
                array_push($parts, 'desc');
            }
            list($sortField, $sortDirection) = $parts;
            $query->orderBy($sortField, $sortDirection);
        }

        return $query->take($pageLimit)->get();
    }
}