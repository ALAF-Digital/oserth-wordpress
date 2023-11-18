<?php
// MY ACCOUNT: company data tab
// 1. Insert the new endpoint into the My Account menu
//add_filter( 'user_registration_account_menu_items', 'ur_company_menu_items', 10, 1 );
function ur_company_menu_items( $items ) {
  $items['refund-request'] = 'Refund Request';
  $items['wishlist'] = 'My Favourites';
  $items['reviews'] = 'Reviews';
  return $items;
}
// 2. Add new query var
// add_filter( 'query_vars', 'ur_cegadatok_endpoint_query_vars', 0 );
function ur_cegadatok_endpoint_query_vars( $vars ) {
  $vars[] = 'refund-request';
  $vars[] = 'wishlist';
  $vars[] = 'reviews';
  return $vars;
}
// 3. Register new endpoint 
add_action( 'init', 'ur_add_new_my_account_endpoint' );
function ur_add_new_my_account_endpoint() {
    //add_rewrite_endpoint( 'refund-request', EP_PAGES );  // EP_ROOT | EP_PAGES  ????
    add_rewrite_endpoint( 'wishlist', EP_PAGES );  // EP_ROOT | EP_PAGES  ????
    //add_rewrite_endpoint( 'reviews', EP_PAGES );  // EP_ROOT | EP_PAGES  ????
  }
// 4. Add content to the new endpoint
  add_action( 'woocommerce_account_wishlist_endpoint', 'ur_new_item_wishlist_endpoint_content' );

  function ur_new_item_wishlist_endpoint_content() {
    //content goes here
    echo '<div class="wishlist-products">'.do_shortcode('[ti_wishlistsview]').'</div>';    
  }


 // add_action( 'woocommerce_account_reviews_endpoint', 'ur_new_item_reviews_endpoint_content' );

  function ur_new_item_reviews_endpoint_content() {
    //content goes here
    echo do_shortcode('[site_reviews assigned_users="user_id"]');    
  }


 // add_action( 'woocommerce_account_refund-request_endpoint', 'ur_new_item_refund_request_endpoint_content' );

  function ur_new_item_refund_request_endpoint_content() {
    //content goes here
    // Display "completed" orders count
    $statuses = ['refunded', 'refund-requested','refund-approved', 'refund-cancelled'];
    $has_orders = wc_get_orders( ['limit' => -1, 'status' => $statuses, 'customer_id' => get_current_user_id()] );
    if ( $has_orders ) : ?>

      <div class="main-account-inner-container scroll-01">

        <div class="main-order-list-container scroll">

          <div class="main-heading-list">
            <ul>
              <?php $column_names = array(); foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :  $column_names[] = esc_html( $column_name ); ?>
              
              <li> <span class="nobr"><?php echo esc_html( $column_name ); ?></span></li>
              
            <?php endforeach; ?>
          </ul>
        </div>

        <?php
        foreach ( $has_orders as $customer_order ) { 
        $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
        $data = $order->data;
        $item_count = $order->get_item_count() - $order->get_item_count_refunded();
      ?><div class="odr-list"><div class="mobile-heading-list"><ul><?php foreach ($column_names as $key => $value) { ?><li><?php echo $value; ?></li><?php } ?></ul>  </div>
      <ul class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
        <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : 
          if ( 'order-actions' === $column_id ) :  $class_li = 'button_li_class_orders'; endif;
          ?>



          <li class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?> <?php echo $class_li; ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
            <?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
              <?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

            <?php elseif ( 'order-number' === $column_id ) : ?>
              <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                <?php echo esc_html( $order->get_order_number() ); ?>
              </a>

            <?php elseif ( 'order-date' === $column_id ) : ?>
              <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( $order->get_date_created()->format ('d/m/Y')  ); ?></time>

            <?php elseif ( 'ship-to' === $column_id ) : ?>

              <?php echo $data['shipping']['first_name'].' '.$data['shipping']['last_name']; ?>

            <?php elseif ( 'order-total' === $column_id ) : ?>
              <?php
              /* translators: 1: formatted order total 2: total order items */
              echo wp_kses_post( $order->get_formatted_order_total()  );
              ?>

            <?php elseif ( 'order-status' === $column_id ) : ?>
              <span class="status-<?php echo sanitize_title( wc_get_order_status_name( $order->get_status() ) ); ?>"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span>

            <?php elseif ( 'order-actions' === $column_id ) : ?>
              <?php
              $actions = wc_get_account_orders_actions( $order );

              if ( ! empty( $actions ) ) {
                  foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
                    echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button videw-but ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
                  }
                }
                ?>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>
      <?php
    }
    ?>


    <?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>
    

    <?php if ( 1 < $customer_orders->max_num_pages ) : ?>
      <div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
        <?php if ( 1 !== $current_page ) : ?>
          <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
        <?php endif; ?>

        <?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
          <a style=" margin-top: 10px; margin-bottom: 10px;" class="woocommerce-button  but-01 black-but woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  <?php else : ?>
    <div class="woocommerce-order-buttons">

      <?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
        <?php /* ?><a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
          <?php esc_html_e( 'Go to the shop', 'woocommerce' ); ?>
          </a><?php */ ?>
        </div>

      </div>
    </div>

  <?php endif;  


}

// 5. Change endpoint title
add_filter( 'the_title', 'ur_cegadatok_endpoint_title' );
function ur_cegadatok_endpoint_title( $title ) {
  global $wp_query; 
  if ( isset( $wp_query->query_vars['wishlist'] ) && in_the_loop() && is_account_page() ) { 

    $title = 'My Favourites';
  }
  /*if ( isset( $wp_query->query_vars['refund-request'] ) && in_the_loop() && is_account_page() ) { 

    $title = 'Refund Request';
  }
  if ( isset( $wp_query->query_vars['reviews'] ) && in_the_loop() && is_account_page() ) { 

    $title = 'Reviews';
  }*/
  return $title;
}


add_filter ( 'woocommerce_account_menu_items', 'woo_remove_my_account_links' );
function woo_remove_my_account_links( $menu_links ){

  //unset( $menu_links['edit-address'] ); // Addresses
  unset( $menu_links['dashboard'] ); // Remove Dashboard
  //unset( $menu_links['payment-methods'] ); // Remove Payment Methods
  //unset( $menu_links['orders'] ); // Remove Orders
  unset( $menu_links['downloads'] ); // Disable Downloads
  //unset( $menu_links['edit-account'] ); // Remove Account details tab
  //unset( $menu_links['customer-logout'] ); // Remove Logout link
  
  return $menu_links;
  
}


/**
  * Edit my account menu order
  */

function my_account_menu_order() {
  $menuOrder = array(
    'dashboard'          => __( 'Dashboard', 'woocommerce' ),
    'orders'             => __( 'My Orders', 'woocommerce' ),
    'wishlist'           => __( 'My Wishlist', 'woocommerce' ),
    //'refund-request'     => __( 'Refund Request', 'woocommerce' ),
    'edit-address'       => __( 'Address Book', 'woocommerce' ),
    //'reviews'            => __( 'Reviews', 'woocommerce' ),
    'edit-account'       => __( 'Account Information', 'woocommerce' ),
    'customer-logout'    => __( 'Logout', 'woocommerce' ),
  );
  return $menuOrder;
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


//add_filter( 'woocommerce_get_endpoint_url', 'woo_hook_endpoint', 10, 4 );
function woo_hook_endpoint( $url, $endpoint, $value, $permalink ){

 if( $endpoint === 'wishlist' ) {

    // ok, here is the place for your custom URL, it could be external
  $url = site_url().'my-account/wishlist';

}

return $url;

}


function db_display_current_endpoint() {
  if ( is_account_page() ) {
   
    $endpoint = WC()->query->get_current_endpoint();
    switch ($endpoint) {
      case "dashboard":
      $endpoint_title = "Dashboard";
      break;
      case "orders":## ==> Define HERE the statuses of that orders 
      $order_statuses = array('wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed', 'wc-cancelled', 'wc-refunded', 'wc-failed');

      ## ==> Define HERE the customer ID
      $customer_user_id = get_current_user_id(); // current user ID here for example

      // Getting current customer orders
      $total_customer_orders = wc_get_orders( array(
        'meta_key' => '_customer_user',
        'meta_value' => $customer_user_id,
        'post_status' => $order_statuses,
        'numberposts' => -1
      ) );

      $total_orders = count($total_customer_orders);


      $endpoint_title = "My Orders"; //<span>(".$total_orders." total)</span>
      break; 

      case "wishlist":
      $endpoint_title = "My Favourites";
      break; 

      /*case "refund-request":
      $endpoint_title = "Refund Request";
      break;
     
      case "reviews":
      $endpoint_title = "Reviews";
      break;*/

      case "edit-address":
      $endpoint_title = 'My Address';
      break;

      case "edit-account":
      $endpoint_title = "My Account";
      break;

      default:
      $endpoint_title = "";
      break;         
    }
    ob_start();
    if($endpoint_title!= ''){ echo '<h3 class="endpoint-title">' . $endpoint_title . '</h3>'; }else{ echo '<h3 class="endpoint-title">' .get_the_title(). '</h3>'; }
    return ob_get_clean();
  }
}

add_shortcode( 'current_endpoint', 'db_display_current_endpoint' );



function WOO_login_redirect( $redirect, $user ) {

    $redirect_page_id = url_to_postid( $redirect );
    $checkout_page_id = wc_get_page_id( 'checkout' );

    if ($redirect_page_id == $checkout_page_id) {
        return $redirect;
    }

    return get_permalink(get_option('woocommerce_myaccount_page_id')) . '/edit-account';

}

add_action('woocommerce_login_redirect', 'WOO_login_redirect', 10, 2);