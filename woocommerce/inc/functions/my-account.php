<?php 
//remove_action( 'woocommerce_before_customer_login_form','woocommerce_output_all_notices', 10 ); //Remove notices in customer login form
//remove_action( 'woocommerce_before_lost_password_form','woocommerce_output_all_notices', 10 ); //Remove notices in customer lost password form

add_action( 'wp_print_scripts', 'iconic_remove_password_strength', 10 );//Remove password strength check.
add_filter( 'woocommerce_my_account_my_orders_actions', 'cs_add_order_again_to_my_orders_actions', 50, 2 ); //Add order again button in my orders actions.

add_action('wp_ajax_setDefaultAddress', 'setDefaultAddress'); // Set Default Address
add_action('wp_ajax_nopriv_setDefaultAddress', 'setDefaultAddress'); // for users that are not logged in.

add_action('wp_ajax_removeAddress', 'removeAddress');// Remove additional address
add_action('wp_ajax_nopriv_removeAddress', 'removeAddress');//for users that are not logged in.

add_filter( 'woocommerce_account_orders_columns', 'new_orders_columns' ); // orderv columns in My Orders Section
add_filter('woocommerce_save_account_details_required_fields', 'wc_save_account_details_required_fields' );// Remove mandatory option in my account details fields

add_action( 'woocommerce_created_customer', 'save_name_fields' );// Save fields while creating the customer


//add_action( 'woocommerce_edit_account_form', 'extrafields_to_edit_account_form' ); // Add the custom field 

add_action( 'woocommerce_save_account_details', 'extra_account_details', 12, 1 ); // Save the custom field

add_action( 'woocommerce_customer_save_address', 'action_woocommerce_customer_save_address', 99, 2 ); //redirection after account information update

add_filter('get_avatar_data', 'ht1_change_avatar', 100, 2);// change user avatar

add_filter('woocommerce_address_to_edit', function($address) {
  foreach ($address as $index => $a) {
    if (!isset($address[$index]['placeholder']) && isset($address[$index]['label'])) {
      $address[$index]['placeholder'] = $address[$index]['label'];
    }
  }
  return $address;
});

function cs_add_order_again_to_my_orders_actions( $actions, $order ) {
  if ( $order->has_status( 'completed' ) ) {
    $actions['order-again'] = array(
      'url'  => wp_nonce_url( add_query_arg( 'order_again', $order->id ) , 'woocommerce-order_again' ),
      'name' => __( 'Re-Order', 'woocommerce' )
    );
  }

  return $actions;
}

function setDefaultAddress(){
  $customer_id = $_REQUEST['customer_id'];
  $address_id = $_REQUEST['address_id'];
  $default_address = $_REQUEST['default_address'];
  $otherAddr = get_user_meta( $customer_id, 'wc_multiple_shipping_addresses', true );

  if($default_address!=''){

    $otherAddr[$default_address]['shipping_address_is_default'] = 'false';
  }
  $otherAddr[$address_id]['shipping_address_is_default'] = 'true';

  update_user_meta( $customer_id, 'wc_multiple_shipping_addresses', $otherAddr );
  echo $address_id;
  die();
}

function removeAddress(){
  $customer_id = $_REQUEST['customer_id'];
  $address_id = $_REQUEST['address_id'];
  $otherAddr = get_user_meta( $customer_id, 'wc_multiple_shipping_addresses', true );
  unset($otherAddr[$address_id]);

  update_user_meta( $customer_id, 'wc_multiple_shipping_addresses', $otherAddr );
  echo $address_id;
  die();
}

function new_orders_columns( $columns = array() ) {

    // Hide the columns
  if( isset($columns['order-total']) ) {
  // Unsets the columns which you want to hide
    unset( $columns['order-number'] );
    unset( $columns['order-date'] );
    unset( $columns['order-status'] );
    unset( $columns['order-total'] );
    unset( $columns['order-actions'] );
  }

    // Add new columns
  $columns['order-number'] = __( 'Order', 'woocommerce' );
  $columns['order-date'] = __( 'Date', 'woocommerce' );
  $columns['order-total'] = __( 'Order Total', 'woocommerce' );
  //$columns['track-shipment'] = __( 'Track Your Shipment', 'woocommerce' );
  $columns['order-status'] = __( 'Status', 'woocommerce' );
  $columns['order-actions'] = __( 'Action', 'woocommerce' );

  return $columns;
}

function wc_save_account_details_required_fields( $required_fields ){
  unset( $required_fields['account_display_name'] );
  return $required_fields;
}

function  save_name_fields( $customer_id ) {
  if ( isset( $_POST['billing_first_name'] ) ) {
    update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
  }
  if ( isset( $_POST['billing_last_name'] ) ) {
    update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
  }

  if ( isset( $_POST['billing_first_name'] ) && isset( $_POST['billing_last_name'] ) ) {

    if ( !empty( $_POST['billing_first_name'] ) && !empty( $_POST['billing_last_name'] ) ) {

      $display_name = sanitize_text_field( $_POST['billing_first_name'] ) . ' ' . sanitize_text_field( $_POST['billing_last_name'] );
      wp_update_user( array( 'ID' => $customer_id, 'display_name' => $display_name ) );
    }
    
  }

}


function iconic_remove_password_strength() {
  wp_dequeue_script( 'wc-password-strength-meter' );
}




function extrafields_to_edit_account_form() {
  $user = wp_get_current_user();
  ?>
  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="phone_number"><?php _e( 'Phone Number', 'woocommerce' ); ?></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
  </p>
  <?php
}



function extra_account_details( $user_id ) {
    // For billing phone
  if( isset( $_POST['billing_phone'] ) )
    update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	
  if( isset( $_POST['gender'] ) )
    update_user_meta( $user_id, 'gender', sanitize_text_field( $_POST['gender'] ) );

  if( isset( $_POST['avatar'] ) )
    update_user_meta( $user_id, 'avatar', sanitize_text_field( $_POST['avatar'] ) );

  if( isset( $_POST['alternate_phone'] ) )
    update_user_meta( $user_id, 'alternate_phone', sanitize_text_field( $_POST['alternate_phone'] ) );

  if( isset( $_POST['alternate_email'] ) )
    update_user_meta( $user_id, 'alternate_email', sanitize_text_field( $_POST['alternate_email'] ) );

  if( isset( $_POST['corporate_coupon'] ) )
    update_user_meta( $user_id, 'corporate_coupon', sanitize_text_field( $_POST['corporate_coupon'] ) );

  if( isset( $_POST['packing'] ) )
    update_user_meta( $user_id, 'packing', sanitize_text_field( $_POST['packing'] ) );

  if( isset( $_POST['go_green'] ) )
    update_user_meta( $user_id, 'go_green', sanitize_text_field( $_POST['go_green'] ) );

  if( isset( $_POST['alternate_products'] ) )
    update_user_meta( $user_id, 'alternate_products', sanitize_text_field( $_POST['alternate_products'] ) );


}


function ht1_change_avatar($args, $id_or_email) { 
  $avatar_url = get_user_meta($id_or_email, 'avatar', true); 
  $args['url'] = $avatar_url;

  return $args;
} // end of function



function action_woocommerce_customer_save_address( $user_id, $load_address ) {;
       wp_safe_redirect(site_url('/my-account/edit-address')); 
       exit;
};