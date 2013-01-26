    <section id="header-image">
        <?php $header_image = cougar_header_image_data($post); ?>
        <img class="header-image__image" src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>" />

        <p class="header-image__overlay">
          <?php $header_text = cougar_header_banner_text($post); ?>
          <span><?php echo $header_text['title']; ?></span>
          <?php echo $header_text['caption']; ?>
        </p>
    </section>
