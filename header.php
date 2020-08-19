<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- FaceBook Specific Page Settings. -->
    <meta property="og:url" content="<?php echo site_url();?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo get_bloginfo( 'name' ); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>" />
    <meta property="og:description" content="<?php $blog_title = get_bloginfo( 'description' ); ?>" />
    
    <!-- These next two meta options need to be changed by the End User -->
    <meta property="og:image" content="<?php echo site_url();?>/wp-content/themes/wp-foundation/img/assets/DW_512.jpg" />
    <meta property="fb.admins" content="devworksosi" />
    
    <?php
    wp_head(); 
    ?>
    
  </head>
  <body <?php body_class(); ?>>
    <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong><?php echo get_bloginfo( 'name' ); ?></strong></a></h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li <?php if (is_page('home') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/') ?>">Home</a></li>
              <!--<li><a href="#">Programs</a></li>-->
            <li <?php if (get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item"';  ?>><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
            <!--<li><a href="#">Campuses</a></li>-->
            <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/blog'); ?>">Blog</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
		<?php if(is_user_logged_in()) { ?>
            <a href="<?php echo wp_logout_url();  ?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo">
            <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
            <span class="btn__text">Log Out</span>
            </a>
			
            <?php } else { ?>
              <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
              <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
             <?php } ?>
        </div>
      </div>
    </div>
  </header>
