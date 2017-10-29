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
//        if (empty($filter['menu_ids'])) return [];
//
//        $result = [];
//
//        if (!empty($filter['page']) AND $filter['page'] !== 0) {
//            $filter['page'] = ($filter['page'] - 1) * $filter['limit'];
//        }
//
//        if ($this->db->limit($filter['limit'], $filter['page'])) {
//            $this->db->select('menu_id, menu_name, menu_description, menu_price, menu_photo');
//            $this->db->from('menus');
//            $this->db->where('menu_status', '1');
//            $this->db->where_in('menu_id', $filter['menu_ids']);
//
//            $query = $this->db->get();
//
//            if ($query->num_rows() > 0) {
//                $this->load->model('Image_tool_model');
//                $dimension_w = (!empty($filter['dimension_w'])) ? $filter['dimension_w'] : null;
//                $dimension_h = (!empty($filter['dimension_h'])) ? $filter['dimension_h'] : null;
//
//                foreach ($query->result_array() as $row) {
//                    if (!empty($dimension_w) AND !empty($dimension_h)) {
//                        if (!empty($row['menu_photo'])) {
//                            $row['menu_photo'] = Image_tool_model::resize($row['menu_photo'], $dimension_w, $dimension_h);
//                        }
//                        else {
//                            $row['menu_photo'] = Image_tool_model::resize('data/no_photo.png', $dimension_w, $dimension_h);
//                        }
//                    }
//
//                    $result[$row['menu_id']] = $row;
//                }
//            }
//        }
//
//        return $result;
    }
}