<footer class="site-footer">

    <div class="site-footer__inner container container--narrow">

      <div class="group">

        <div class="site-footer__col-one">
          <h1 class="school-logo-text school-logo-text--alt-color">&copy; <?php echo date("Y");?> <a href="<?php echo site_url() ?>"><?php echo get_bloginfo( 'name' ); ?></a></h1>
        </div>

        <div class="site-footer__col-two-three-group">
          <div class="site-footer__col-two">
            <h3 class="headline headline--small">Explore</h3>
            <nav class="nav-list">
              <ul>
                <li><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>
                <li><a href="<?php echo site_url('/events') ?>">Events</a></li>
              </ul>
            </nav>
          </div>

          <div class="site-footer__col-three">
            <h3 class="headline headline--small">Learn</h3>
            <nav class="nav-list">
              <ul>
                <!--<li><a href="#">Legal</a></li>-->
                <li><a href="<?php echo site_url('/privacy-policy') ?>">Privacy</a></li>
              </ul>
            </nav>
          </div>
        </div>

        <div class="site-footer__col-four">
          <h3 class="headline headline--small">Connect With Us</h3>
          <nav>
            <ul class="min-list social-icons-list group">
              <!--<li><a href="https://www.facebook.com/#" class="social-color-facebook" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
              <!--<li><a href="https://www.twitter.com/#" class="social-color-twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
			  <!--
              <li><a href="https://www.youtube.com/#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href="https://www.linkdin.com/#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="https://www.instagram.com/explore/locations/#" class="social-color-instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              -->
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
