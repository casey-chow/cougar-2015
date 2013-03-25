    <section class="header-image row">
        <?php $header_image = cougar_header_image_data($post); ?>
        <img class="header-image__image fifteen columns" src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>" />

        <?php if (cougar_page_has_banner_text($post)): ?>
        <div class="header-image__overlay group">
          <div class="header-image__inner">
            <?php echo $header_image['caption']; ?>
          </div>
        </div>
        <?php endif; ?>
    </section>
