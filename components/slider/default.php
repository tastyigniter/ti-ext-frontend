<?php if ($displaySlides) { ?>
    <div id="<?= $sliderId; ?>" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $index = 0;
            foreach ($slidesImages as $slide) { ?>
                <?php $index++; ?>
                <li
                    class="<?= $index == 1 ? 'active' : ''; ?>"
                    data-target="#<?= $sliderId; ?>"
                    data-slide-to="<?= $sliderId; ?>"
                ></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner">
            <?php $index = 0;
            foreach ($slidesImages as $slide) { ?>
                <?php $index++; ?>
                <div class="carousel-item <?= $index == 1 ? 'active' : ''; ?>">
                    <div class="slider-caption">
                        <?= $slide['caption']; ?>
                    </div>

                    <img src="<?= $slide['image_src']; ?>"
                         style="height:<?= $slide['height']; ?>px; width:100%;"
                         alt="<?= $slide['image_src']; ?>" />
                </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#<?= $sliderId; ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#<?= $sliderId; ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
<?php } ?>