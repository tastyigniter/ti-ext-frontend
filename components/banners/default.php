<div id="banner-box" class="module-box">
    <?php if ($banner->isCustom) { ?>
        <?= $banner->value; ?>
    <?php }
    else { ?>
        <?= partial('@images', ['banner' => $banner]); ?>
    <?php } ?>
</div>