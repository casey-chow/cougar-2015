  </div><!--/.wrapper-->

  <div class="footer__wrapper">
    <footer class="footer">
      <div class="footer__wordmark">Cougar Robotics</div>
      <nav class="links footer__section">
        <h1 class="footer__section__title links__title">Navigation</h1>
        <div class="footer__section__inner">
          <?php cougar_footer_links(); ?>
        </div>
      </nav>
      <nav class="sponsors footer__section">
        <h1 class="footer__section__title">Sponsors</h1>
        <div class="footer__section__inner row">
          <ul class="four columns sponsors__group--for-nrg">
            <?php get_sponsor_link('nrg', 'NRG Energy'); ?>
          </ul>
          <div class="eight columns pull-1 sponsors__group--center">
            <ul class="sponsors__group group">
              <?php get_sponsor_link('mtsd', 'Montgomery Township Schools'); ?>
              <?php get_sponsor_link('rotary', 'Montgomery Rotary Club', true); ?>
            </ul>
            <ul class="sponsors__group group">
              <?php get_sponsor_link('ak', 'A&K Equipment Co'); ?>
              <?php get_sponsor_link('pba', 'Montgomery PBA #355'); ?>
              <?php get_sponsor_link('bms', 'Bristol Myers Squibb'); ?>
            </ul>
          </div>
          <ul class="three columns sponsors__group--for-dod">
            <?php get_sponsor_link('dod', 'Department of Defense'); ?>
            <?php get_sponsor_link('ndep', 'National Defense Education Program', true); ?>
          </ul>
        </div>
      </nav>
      <p class="footer__copyright row">
        Copyright &copy; 2013 Cougar Robotics. Redistributable under the
        CC-BY-NC-ND license. Logos and trademarks copyright and trademark
        their respective owners.
      </p>
    </footer><!--/.footer-->
  </div><!--/.footer__wrapper-->

  <?php wp_footer(); ?>
</body>
</html>
