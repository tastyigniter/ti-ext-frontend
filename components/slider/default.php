<div
    id="<?= $sliderSelectorId; ?>"
    class="carousel slide"
    data-ride="carousel"
>
    <?php $countThumbs = count($__SELF__->slides()); ?>
    <?php if ($showSliderIndicators) { ?>
        <ol class="carousel-indicators">
            <?php for ($index = 1; $index < $countThumbs; $index++) { ?>
                <li
                    class="<?= $index == 1 ? 'active' : ''; ?>"
                    data-target="#<?= $sliderSelectorId; ?>"
                    data-slide-to="<?= $sliderSelectorId; ?>"
                ></li>
            <?php } ?>
        </ol>
    <?php } ?>

    <div class="carousel-inner">
        <?php $index = 0;
        foreach ($__SELF__->slides() as $slide) { ?>
            <?php $index++; ?>
            <div
                class="carousel-item <?= $index == 1 ? 'active' : ''; ?>"
                style="max-height:<?= $sliderHeight; ?>;"
            >
                <img
                    src="<?= $slide->getThumb(); ?>"
                    class="d-block w-100"
                    alt="<?= e($slide->getCustomProperty('title')); ?>"/>

                <?php if ($showSliderCaptions AND strlen($slide->getCustomProperty('description'))) { ?>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= e($slide->getCustomProperty('title')); ?></h5>
                        <p><?= e($slide->getCustomProperty('description')); ?></p>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php if ($showSliderControls AND $countThumbs > 1) { ?>
        <a class="carousel-control-prev" href="#<?= $sliderSelectorId; ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#<?= $sliderSelectorId; ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    <?php } ?>
</div>
