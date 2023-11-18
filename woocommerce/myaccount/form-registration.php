  <?php
  /**
  * Registration form.
  *
  * @author 	    Astoundify
  * @package 	WooCommerce-Simple-Registration
  * @version     1.0.0
  */

  if ( ! defined( 'ABSPATH' ) ) exit;
  wp_enqueue_script( 'wc-password-strength-meter' );
  ?>

  <style>.login-form-container{display: none !important;}</style>
  <div class="register-form-page">
  <h1 class="main-title">REGISTER</h1>
    <form method="post">

    <div class="socal-login">
	<a href="#" class="facebook"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login-icon1.png" alt="image"></a>
	<a href="#" class="google"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login-icon2.png" alt="image"></a>
</div>

<div class="login-seperation">Or</div>


<div class="login-form-box">

                         <div class="login-title">Please fill in the information below:</div>

      <?php do_action( 'woocommerce_register_form_start' ); ?>
      <!-- <div class="form-row"> -->
        <div class="form-row">
          <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
            <input placeholder="<?php esc_html_e( 'Enter your username', 'woocommerce' ); ?>" type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
          <?php endif; ?>
        </div>
        <div class="form-row">
         
          <input placeholder="Email" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
        </div>
        <!-- </div> -->


        <div class="form-row">
        <input placeholder="Mobile" type="Number" class="woocommerce-Input woocommerce-Input--text input-text" name="phone" id="reg_phone" />
        </div>

        <div class="form-row">
        <input placeholder="Password" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
        </div>
        <div class="form-row">
          <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
        
            <input placeholder="Password" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
            <?php /* ?><input placeholder="<?php esc_html_e( 'Confirm your password', 'woocommerce' ); ?>" type="password" class="woocommerce-Input woocommerce-Input--text form-control" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" /><?php */ ?>
          <?php endif; ?>
        </div>
        <?php /* ?><div class="register-form-footer">
          <div class="terms">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme container-check">
              <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="terms" type="checkbox" id="rememberme" value="on" /> 
              <span class="checkmark"></span>&nbsp;<?php esc_html_e( 'I agreed to the ', 'woocommerce' ); ?><a href="#" class="terms-of-use"> <?php esc_html_e( ' terms of use', 'woocommerce' ); ?></a>
            </label>
            </div> 
            </div><?php */ ?>
            <!-- Spam Trap -->


            <div class="register-terms">  <div class="remember-forgot">
<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme container-check">
<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
<span class="checkmark"></span> <span class="remember-text">I agree to the terms and <a href="#.">conditions</a> and <a href="#.">privacy policy</a></span>
</label>
</div></div>

<div class="register-terms">  <div class="remember-forgot">
<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme container-check">
<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
<span class="checkmark"></span> <span class="remember-text">I agree to receive latest offers and updates</span>
</label>
</div></div>


            <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;">
              <label for="trap"> <?php _e( 'Anti-spam', 'woocommerce-simple-registration' ); ?>  </label>
              <input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" />
            </div>
            <div class="action-btns" style="display: none !important;">
              <?php do_action( 'woocommerce_register_form' ); ?>
              <?php do_action( 'woocommerce_simple_registration_form' ); ?>
            </div>
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
          
            <button type="submit" class="main-btn"  name="register" value="<?php esc_attr_e( 'Register', 'woocommerce-simple-registration' ); ?>"><span><div class="main-btn-round"></div>Create Account</span></button>
          
            <?php do_action( 'woocommerce_register_form_end' ); ?> 
            <div class="reg-widget-bottom">
              <div><?php esc_html_e( 'Already have an account?', 'woocommerce' ); ?> <a href="<?php echo site_url().'/my-account/'; ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></a></div>
            </div>

            </div>
          </form>

        </div>


