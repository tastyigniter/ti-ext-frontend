<?php if (count($featuredMenuItems)) { ?>
    <div id="featured-menu-box" class="module-box py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
                    <h2 class="display-5 mb-3"><?= $featuredTitle; ?></h2>
                </div>
            </div>

            <div class="row">
                <?php foreach ($featuredMenuItems as $featuredItem) { ?>
                    <div class="col-sm-<?= round(12 / $featuredPerRow); ?> mb-3 mb-sm-0">
                        <div class="card h-100">
                            <?php if ($featuredItem->hasMedia()) { ?>
                                <img
                                    class="card-img-top"
                                    src="<?= $featuredItem->getThumb([
                                        'width' => $featuredWidth,
                                        'height' => $featuredHeight,
                                    ]); ?>" alt="<?= $featuredItem->getBuyableName(); ?>"/>
                            <?php } ?>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?= $featuredItem->getBuyableName(); ?>
                                    <small><?= currency_format($featuredItem->getBuyablePrice()); ?></small>
                                </h4>
                                <p class="card-text"><?= $featuredItem['menu_description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
