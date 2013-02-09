    <section class="header-image row">
        <?php $header_image = cougar_header_image_data($post); ?>
        <img class="header-image__image fifteen columns" src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>" />

        <?php if (cougar_page_has_banner_text($post)): ?>
        <div class="header-image__overlay group">
          <div class="header-image__inner">
            <?php $header_text = cougar_header_banner_text($post); ?>
            <h1 class="header-image__overlay__title"><?php echo $header_text['title']; ?></h1>
            <p class="header-image__overlay__caption"><?php echo $header_text['caption']; ?></p>
          </div>
        </div>
        <?php endif; ?>
    </section>
