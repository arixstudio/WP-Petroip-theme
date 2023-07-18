<footer class="site-footer">
  <div class="container">
    <div class="row px-4">
      <div class="col-md-6">
        <?php if ( is_active_sidebar( 'footer-column-1' ) ) : ?>
          <div class="footer-column-1">
            <?php dynamic_sidebar( 'footer-column-1' ); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <?php if ( is_active_sidebar( 'footer-column-2' ) ) : ?>
          <div class="footer-column-2">
            <?php dynamic_sidebar( 'footer-column-2' ); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="bottom-bar container">
    <div class="row">
      <div class="col-md-6">
        <?php if ( is_active_sidebar( 'bottom-bar-column-1' ) ) : ?>
          <div class="bottom-bar-column-1">
            <?php dynamic_sidebar( 'bottom-bar-column-1' ); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <?php if ( is_active_sidebar( 'bottom-bar-column-2' ) ) : ?>
          <div class="bottom-bar-column-2">
            <?php dynamic_sidebar( 'bottom-bar-column-2' ); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>