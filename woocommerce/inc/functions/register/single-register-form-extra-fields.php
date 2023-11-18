<?php



/*// Separete Login form and registration form */

add_action('woocommerce_before_customer_login_form','load_registration_form', 2);

function load_registration_form(){ 

    if(isset($_GET['action'])=='register'){

      woocommerce_get_template( 'myaccount/form-registration.php' );

  }

} 





// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.

//add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);

function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {

    global $woocommerce;

    extract( $_POST );



    if ( strcmp( $password, $password2 ) !== 0 ) {

      return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );

  }



  if ( $_POST['terms'] != 'on' ) {

      return new WP_Error( 'registration-error', __( 'Please agree to the terms of use.', 'woocommerce' ) );

  }



  return $reg_errors;

}







/**

 * @snippet       Add First & Last Name to My Account Register Form - WooCommerce

 * @how-to        Get CustomizeWoo.com FREE

 * @author        Rodolfo Melogli

 * @compatible    WC 3.9

 * @donate $9     https://businessbloomer.com/bloomer-armada/

 */



///////////////////////////////

// 1. ADD FIELDS



add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );



function bbloomer_add_name_woo_account_registration() {

    ?>

    <div class="form-row">

        <div class="col-md-6 col-sm-6">

            <div class="form-group">

                <label for=""><?php esc_html_e( 'First name', 'woocommerce' ); ?></label>

                <input type="text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>"  class="woocommerce-Input woocommerce-Input--text input-text" placeholder="" />

            </div>

        </div>

    </div>

    <div class="form-row">

        <div class="col-md-6 col-sm-6">

            <div class="form-group">

                <label for=""><?php esc_html_e( 'Last name', 'woocommerce' ); ?></label>

                <input type="text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="" />

            </div>

        </div>



    </div>



    <?php

}



///////////////////////////////

// 2. VALIDATE FIELDS



add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );



function bbloomer_validate_name_fields( $errors, $username, $email ) {

    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {

        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );

    }

    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {

        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );

    }

    return $errors;

}



///////////////////////////////

// 3. SAVE FIELDS



add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );



function bbloomer_save_name_fields( $customer_id ) {

    if ( isset( $_POST['billing_first_name'] ) ) {

        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );

    }

    if ( isset( $_POST['billing_last_name'] ) ) {

        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );

    }



}