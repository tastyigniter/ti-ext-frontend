<?php namespace SamPoyigi\FrontEnd\Components;

use SamPoyigi\Featured_menus\Models\FeaturedMenus as FeaturedMenusModel;

class FeaturedMenus extends \System\Classes\BaseComponent
{
    public function defineProperties()
    {
        return [
            'items'         => [
                'label' => 'lang:sampoyigi.frontend::default.featured.label_menus',
                'type'  => 'selectlist',
                'mode'  => 'checkbox',
            ],
            'limit'         => [
                'label'   => 'lang:sampoyigi.frontend::default.featured.label_limit',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 12,
            ],
            'itemsPerRow' => [
                'label'   => 'lang:sampoyigi.frontend::default.featured.label_items_per_row',
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
            'itemWidth'   => [
                'label'   => 'lang:sampoyigi.frontend::default.featured.label_dimension_w',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 400,
            ],
            'itemHeight'   => [
                'label'   => 'lang:sampoyigi.frontend::default.featured.label_dimension_h',
                'span'    => 'right',
                'type'    => 'number',
                'default' => 300,
            ],
        ];
    }

    public static function getMenusOptions()
    {
        return FeaturedMenusModel::dropdown('menu_name');
    }

    public function onRun()
    {
        $this->addCss('css/featured_menus.css', 'featured_menus-css');

        $this->page['featuredTitle'] = $this->property('title', lang('featured_menus::text_featured_menus'));
        $this->page['featuredPerRow'] = $this->property('itemsPerRow', 3);
        $this->page['featuredWidth'] = $this->property('itemWidth', 400);
        $this->page['featuredHeight'] = $this->property('itemHeight', 300);
        $this->page['featuredItems'] = $this->loadItems();
    }

    protected function loadItems()
    {
        return FeaturedMenusModel::getByIds([
            'page'      => '1',
            'pageLimit' => $this->property('limit'),
            'menu_ids'  => $this->property('items', []),
        ]);
    }
}
