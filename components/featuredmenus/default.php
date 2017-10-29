<div id="featured-menu-box" class="module-box">
    <div class="heading-section bottom-spacing-20">
        <h2><?= $featuredTitle; ?></h2>
        <span class="under-heading"></span>
    </div>

    <div class="row">
        <?php foreach ($featuredMenus as $menu) { ?>
            <div class="col-xs-6 col-sm-6 col-md-<?= round(12 / $featuredPerRow); ?>">
                <div class="featured-menu">
                    <div class="menu-thumb">
                        <img src="<?= $menu->getThumb([
                            'width'  => $featuredWidth,
                            'height' => $featuredHeight,
                        ]); ?>" alt=""/>
                    </div>
                    <div class="menu-content">
                        <div class="content-show">
                            <h4><?= $menu['menu_name']; ?></h4>
                            <span><?= currency_format($menu['menu_price']); ?></span>
                        </div>
                        <div class="content-hide">
                            <p><?= $menu['menu_description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
