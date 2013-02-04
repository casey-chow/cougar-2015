    <section class="header-image row">
        <?php $header_image = cougar_header_image_data($post); ?>
        <img class="header-image__image fifteen columns" src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>" />

        <div class="header-image__overlay">
          <?php $header_text = cougar_header_banner_text($post); ?>
          <h1 class="header-image__overlay__title"><?php echo $header_text['title']; ?></h1>
          <p class="header-image__overlay__caption"><?php echo $header_text['caption']; ?></p>
        </div>
    </section>
