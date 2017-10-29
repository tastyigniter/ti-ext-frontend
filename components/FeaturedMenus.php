<?php namespace SamPoyigi\FrontEnd\Components;

use SamPoyigi\Featured_menus\Models\FeaturedMenus_model;

class FeaturedMenus extends \System\Classes\BaseComponent
{
    public function defineProperties()
    {
        return [
            'menus'         => [
                'label' => 'lang:menus',
                'type'  => 'selectlist',
                'mode'  => 'checkbox',
            ],
            'limit'         => [
                'label'   => 'lang:limit',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 12,
            ],
            'items_per_row' => [
                'label'   => 'lang:items_per_row',
                'span'    => 'right',
                'type'    => 'select',
                'default' => 3,
                'options' => [
                    1 => 'One',
                    2 => 'Two',
                    3 => 'Three',
                    4 => 'Four',
                    5 => 'Five',
                    6 => 'Six',
                ],
            ],
            'dimension_w'   => [
                'label'   => 'lang:dimension_w',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 400,
            ],
            'dimension_h'   => [
                'label'   => 'lang:dimension_h',
                'span'    => 'right',
                'type'    => 'number',
                'default' => 300,
            ],
        ];
    }

    public static function getMenusOptions()
    {
        return FeaturedMenus_model::dropdown('menu_name');
    }

    public function onRun()
    {
        $this->addCss(extension_url('featured_menus/assets/featured_menus.css'), 'featured_menus-css');

        $this->page['featuredTitle'] = $this->property('title', lang('featured_menus::text_featured_menus'));
        $this->page['featuredPerRow'] = $this->property('items_per_row', 3);
        $this->page['featuredWidth'] = $this->property('dimension_w', 400);
        $this->page['featuredHeight'] = $this->property('dimension_h', 300);
        $this->page['featuredMenus'] = $this->loadMenus();
    }

    protected function loadMenus()
    {
        return FeaturedMenus_model::getByIds([
            'page'      => '1',
            'pageLimit' => $this->property('limit'),
            'menu_ids'  => $this->property('menus', []),
        ]);
    }
}
