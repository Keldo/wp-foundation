<?php

function brokenfence_files() {
  wp_enqueue_script('main-brokenfence-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('brokenfence_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'brokenfence_files');

function brokenfence_features() {
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'brokenfence_features');

function brokenfence_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            ));
  }
}

add_action('pre_get_posts', 'brokenfence_adjust_queries');

// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

function ourLoginCSS() {
  wp_enqueue_style('brokenfence_main_styles', get_stylesheet_uri());
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginCSS');

function ourLoginTitle() {
  return get_bloginfo('name');
}

add_filter('login_headertitle', 'ourLoginTitle');
function woocommerce_product_category( $args = array() ) {
    $woocommerce_category_id = get_queried_object_id();
  $args = array(
    	'parent' => $woocommerce_category_id
  );
  $terms = get_terms( 'product_cat', $args );
  if ( $terms ) {
    	echo '<ul class="woocommerce-categories">';
    	foreach ( $terms as $term ) {
        	echo '<li class="woocommerce-product-category-page">';
            woocommerce_subcategory_thumbnail( $term );
        	echo '<h2>';
        	echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
        	echo $term->name;
        	echo '</a>';
        	echo '</h2>';
        	echo '</li>';
    	}
    	echo '</ul>';
  }
}
add_action( 'woocommerce_before_shop_loop', 'woocommerce_product_category', 100 );
/**
 * @snippet       Hide Shipping Fields for Local Pickup
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=72660
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.5.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
add_action( 'woocommerce_after_checkout_form', 'brokenfence_disable_shipping_local_pickup' );
function brokenfence_disable_shipping_local_pickup( $available_gateways ) {
   // Part 1: Hide shipping based on the static choice @ Cart
   // Note: "#customer_details .woocommerce-shipping-fields" (formerly "#customer_details .col-2", but was too broad & was also hidding additional fields that aren't shipping related that just happened to be in the second column) strictly depends on your theme
   $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
   $chosen_shipping = $chosen_methods[0];
   if ( 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
   ?>
      <script type="text/javascript">
         jQuery('#customer_details .woocommerce-shipping-fields').fadeOut();
      </script>
   <?php
   }
   // Part 2: Hide shipping based on the dynamic choice @ Checkout
   // Note: "#customer_details .woocommerce-shipping-fields" (formerly "#customer_details .col-2", but was too broad & was also hidding additional fields that aren't shipping related that just happened to be in the second column) strictly depends on your theme
   ?>
      <script type="text/javascript">
         jQuery('form.checkout').on('change','input[name^="shipping_method"]',function() {
            var val = jQuery('input[name^="shipping_method"]:checked').val(); // If it changed, then it must be the radio options so check the one that's selected
            if (val.match("^local_pickup")) {
              jQuery('#customer_details .woocommerce-shipping-fields').fadeOut();
            } else {
              jQuery('#customer_details .woocommerce-shipping-fields').fadeIn();
            }
         });
         // Also check if the zipcode switched to something where local pickup is the only option (similar to what's done in part 1 above, but happen based on what's currently being entered on the page [watch via ajaxComplete since the options that are available/selected might not be present when the zipcode change happens & it needs to load those in via AJAX])
         jQuery(document).ajaxComplete(function(){
	         if(jQuery('input[name^="shipping_method"]').attr('type') === 'hidden'){ // There's only one option so check the hidden input field with the value
	            var val = jQuery('input[name^="shipping_method"]').val();
            }else{ // Otherwise, it must be the radio options so check the one that's selected
	            var val = jQuery('input[name^="shipping_method"]:checked').val();
            }
            if (val.match("^local_pickup")) {
              jQuery('#customer_details .woocommerce-shipping-fields').fadeOut();
            } else {
              jQuery('#customer_details .woocommerce-shipping-fields').fadeIn();
            }
         });
      </script>
   <?php
}

