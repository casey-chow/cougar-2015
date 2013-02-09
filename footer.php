  </div><!--/.wrapper-->

  <div class="footer__wrapper">
    <footer class="footer">
      <div class="footer__wordmark">Cougar Robotics</div>
        <nav class="links footer__section footer__section--type-collapsible">
          <h1 class="footer__section__title links__title">Navigation</h1>
          <div class="inner row">
            <?php cougar_footer_links(); ?>
          </div>
        </nav>
        <nav class="sponsors footer__section footer__section--type-collapsible">
          <h1 class="footer__section__title">Sponsors</h1>
          <div class="inner row">
            <div class="thirteen columns">
              <ul class="sponsors__group group">
                <?php get_sponsor_link('bms', 'Bristol-Myers Squibb', true); ?>
                <?php get_sponsor_link('cognizant', 'Cognizant', true); ?>
                <?php get_sponsor_link('convatec', 'ConvaTec'); ?>
              </ul>
              <ul class="sponsors__group">
                <?php get_sponsor_link('rotary', 'Montgomery Rotary Club', true); ?>
                <?php get_sponsor_link('pba', 'Montgomery Township PBA #355'); ?>
                <?php get_sponsor_link('mtsd', 'Montgomery Township Schools'); ?>
              </ul>
            </div>
            <ul class="two columns sponsors__group--for-ndep">
              <?php get_sponsor_link('ndep', 'National Defense Education Program', true); ?>
            </ul>
          </div>
        </nav>
        <div class="footer__copyright row">
          <p class="inner ten columns centered">
            Copyright &copy; 2012 Cougar Robotics. Redistributable under the
            CC-BY-NC-ND license. Logos and trademarks copyright and trademark
            their respective owners.
          </p>
        </div>
    </footer><!--/.footer-->
  </div><!--/.footer__wrapper-->
  
  <?php wp_footer(); ?>

  <div class="bottom-bar"></div>
</body>
</html>
