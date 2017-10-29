<?php if ($banner->type != 'carousel') { ?>
    <?php $index = 0 ?>
    <?php foreach ($banner->value as $image) { ?>
        <div class="thumbnail" data-width="<?= $image['width']; ?>" data-height="<?= $image['height']; ?>">
            <a href="<?= $banner->clickUrl; ?>">
                <img alt="<?= $banner->altText; ?>"
                     src="<?= $image['url']; ?>"
                     class="thumb img-responsive"/>
            </a>
        </div>
        <?php $index++; ?>
    <?php } ?>
<?php }
else { ?>
    <div class="thumbnail">
        <div id="<?= $banner->id; ?>" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($banner->value); $i++) { ?>
                    <li data-target="#<?= $banner->id; ?>"
                        data-slide-to="<?= $i; ?>"
                        class="<?= ($i === 0) ? 'active' : ''; ?>"></li>
                <?php } ?>
            </ol>

            <div class="carousel-inner">
                <?php $index = 0 ?>
                <?php foreach ($banner->value as $image) { ?>
                    <div class="item <?= ($index === 0) ? 'active' : ''; ?>"
                         data-width="<?= $image['width']; ?>"
                         data-height="<?= $image['height']; ?>"
                    >
                        <a href="<?= $banner->clickUrl; ?>">
                            <img class="img-responsive"
                                 alt="<?= $banner->altText; ?>"
                                 src="<?= $image['url']; ?>"/>
                        </a>
                    </div>
                    <?php $index++; ?>
                <?php } ?>
            </div>

            <a class="left carousel-control"
               href="#<?= $banner->id; ?>"
               data-slide="prev"><span class="fa fa-chevron-left"></span></a>
            <a class="right carousel-control"
               href="#<?= $banner->id; ?>"
               data-slide="next"><span class="fa fa-chevron-right"></span></a>
        </div>
    </div>
<?php } ?>