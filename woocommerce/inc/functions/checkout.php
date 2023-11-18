<?php
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' ); //remove/order form fields

add_filter('woocommerce_default_address_fields', 'override_default_address_checkout_fields', 20, 1); //change form fields placeholders

add_filter( 'woocommerce_states', 'add_uae_emirates' ); //add country states in dropdown

//add_filter( 'woocommerce_available_payment_gateways', 'payment_gateway_disable_country' );//disable paymentgateway country wise

add_filter( 'woocommerce_gateway_icon', 'authorize_gateway_icon', 10, 2 ); //add/change paymentgateway Icon

//add_action( 'woocommerce_checkout_shipping', 'my_custom_display_payments', 20 );//Moving the payments

add_filter( 'woocommerce_order_needs_shipping_address', '__return_true' ); //show shipping address in order email

add_filter( 'woocommerce_formatted_address_force_country_display', '__return_true' );//show country dispaly in order email

add_filter( 'woocommerce_cart_shipping_method_full_label', 'add_free_shipping_label', 10, 2 ); //change free shipping label

//add_action( 'woocommerce_review_order_before_payment', 'content_after_review_order' );// content after review order





function wc_remove_checkout_fields( $fields ) {



  // Billing fields

  /*

  unset( $fields['billing']['billing_email'] );

  unset( $fields['billing']['billing_phone'] );

  unset( $fields['billing']['billing_state'] );

  unset( $fields['billing']['billing_first_name'] );

  unset( $fields['billing']['billing_last_name'] );

  unset( $fields['billing']['billing_city'] );

  unset( $fields['billing']['billing_postcode'] );

  unset( $fields['billing']['billing_address_1'] );*/

  unset( $fields['billing']['billing_company'] );

  unset( $fields['billing']['billing_address_2'] );



  // Shipping fields

  /*

  unset( $fields['shipping']['shipping_phone'] );

  unset( $fields['shipping']['shipping_state'] );

  unset( $fields['shipping']['shipping_first_name'] );

  unset( $fields['shipping']['shipping_last_name'] );

  unset( $fields['shipping']['shipping_city'] );

  unset( $fields['shipping']['shipping_postcode'] );

  unset( $fields['shipping']['shipping_address_1'] );*/

  unset( $fields['shipping']['shipping_company'] );

  unset( $fields['shipping']['shipping_address_2'] );





  // Order fields

  //unset( $fields['order']['order_comments'] );





  $fields['billing']['billing_first_name']['placeholder'] = __('First Name*', 'woocommerce');

  $fields['billing']['billing_last_name']['placeholder'] = __('Last Name*', 'woocommerce');

  $fields['billing']['billing_email']['placeholder'] = __('Email Address*', 'woocommerce');

  $fields['billing']['billing_phone']['placeholder'] = __('Phone Number*', 'woocommerce');





  $fields['shipping']['shipping_first_name']['placeholder'] = __('First Name*', 'woocommerce');

  $fields['shipping']['shipping_last_name']['placeholder'] = __('Last Name*', 'woocommerce');

  $fields['shipping']['shipping_email']['placeholder'] = __('Email Address*', 'woocommerce');

  $fields['shipping']['shipping_phone']['placeholder'] = __('Phone Number*', 'woocommerce');

  

  $fields['order']['order_comments']['placeholder'] = __('Notes about your order, e.g. special notes for delivery.', 'woocommerce');



  $fields['billing']['billing_first_name']['class'][] = 'checkout-field-col'; 

  $fields['billing']['billing_last_name']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_email']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_phone']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_state']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_city']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_postcode']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_address_1']['class'][] = 'checkout-field-col';

  $fields['billing']['billing_country']['class'][] = 'checkout-field-col';





  $fields['shipping']['shipping_first_name']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_last_name']['class'][] = 'checkout-field-col'; 

  $fields['shipping']['shipping_email']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_phone']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_state']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_city']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_postcode']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_address_1']['class'][] = 'checkout-field-col';

  $fields['shipping']['shipping_country']['class'][] = 'checkout-field-col';





   // default priorities: 

 // 'first_name' - 10

 // 'last_name' - 20

 // 'company' - 30

 // 'country' - 40

 // 'address_1' - 50

 // 'address_2' - 60

 // 'city' - 70

 // 'state' - 80

 // 'postcode' - 90



// e.g. move 'company' above 'first_name':

// just assign priority less than 10

 // $fields['billing']['billing_alt']['priority'] = 8;

  $fields['billing']['billing_first_name']['priority'] = 10;

  $fields['billing']['billing_last_name']['priority'] = 20;

  $fields['billing']['billing_address_1']['priority'] = 30;





//echo "<pre style='display:none;'>"; print_r($fields);echo "</pre>";



  if (!is_user_logged_in()) {

    unset($fields['billing']['billing_alt']);

  }



  return $fields;

}







function override_default_address_checkout_fields( $address_fields ) {

  $address_fields['address_1']['placeholder'] = __('Street Address*', 'woocommerce');

  $address_fields['state']['placeholder'] = __('State / County*', 'woocommerce');

  $address_fields['postcode']['placeholder'] = __('Postcode*', 'woocommerce');

  $address_fields['city']['placeholder'] = __('Town / City*', 'woocommerce');

  return $address_fields;

}





function add_uae_emirates( $states ) {

 $states['AE'] = array(

  'AZ' => __( 'Abu Dhabi', 'woocommerce' ),

  'AJ' => __( 'Ajman', 'woocommerce' ),

  'FU'  => __( 'Fujairah', 'woocommerce' ),

  'SH' => __( 'Sharjah', 'woocommerce' ),

  'DU'  => __( 'Dubai', 'woocommerce' ),

  'RK' => __( 'Ras Al Khaimah', 'woocommerce' ),

  'UQ'  => __( 'Umm Al Quwain', 'woocommerce' ),

);

 return $states;

}







function payment_gateway_disable_country( $available_gateways ) {

  global $woocommerce;

  if ( isset( $available_gateways['cod'] ) && $woocommerce->customer->get_country() <> 'United Arab Emirates' ) {

    unset( $available_gateways['cod'] );

  }

  return $available_gateways;

}







function authorize_gateway_icon( $icon, $id ) { //echo $id;

  if ( $id === 'cod' ) {

    return '<img src="' . get_bloginfo('stylesheet_directory') . '/woocommerce/inc/images/payment-cod.png" alt="COD" />'; 

  } else {

    return $icon;

  }

}





function add_free_shipping_label( $label, $method ) {

  if ( $method->cost == 0 ) {

     //   $label = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().' </span>&nbsp;0.00</bdi></span>'; //not quite elegant hard coded string
	  
	   $label = '<span class="woocommerce-Price-amount amount"><bdi>'.__('Free Shipping', 'woocommerce').'</bdi></span>'; //not quite elegant hard coded string


      }

      return $label;

    }





/**

 * Displaying the Payment Gateways 

 */

function my_custom_display_payments() {

  if ( WC()->cart->needs_payment() ) {

    $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();

    WC()->payment_gateways()->set_current_gateway( $available_gateways );

  } else {

    $available_gateways = array();

  }

  ?>

  <div id="checkout_payments">

    <h3><?php esc_html_e( 'Select Payment Method', 'woocommerce' ); ?></h3>

    <?php if ( WC()->cart->needs_payment() ) : ?>

    <ul class="wc_payment_methods payment_methods methods">

      <?php

      if ( ! empty( $available_gateways ) ) {

        foreach ( $available_gateways as $gateway ) {

          wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );

        }

      } else {

      echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine

    }

    ?>

  </ul>

<?php endif; ?>

</div>

<?php

}



function content_after_review_order() {

 echo '<p>YOUR MESSAGE</p>';

}