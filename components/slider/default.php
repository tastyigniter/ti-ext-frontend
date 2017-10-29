<?php if ($displaySlides) { ?>
    <div id="<?= $sliderId; ?>">
        <div class="flexslider">
            <ul class="slides">
                <?php if (count($slidesImages)) { ?>
                    <?php foreach ($slidesImages as $slide) { ?>
                        <li>
                            <div class="slider-caption">
                                <?= $slide['caption']; ?>
                            </div>

                            <img src="<?= $slide['image_src']; ?>"
                                 style="height:<?= $slide['height']; ?>px; width:100%;"/>
                        </li>
                    <?php } ?>
                <?php }
                else { ?>
                    <li></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>