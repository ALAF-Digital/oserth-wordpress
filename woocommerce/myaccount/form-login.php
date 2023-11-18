 <?php
/**
* Login Form
*
* This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see     https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce/Templates
* @version 4.1.0
*/
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly.
}
?>
<?php wc_print_notices(); ?>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>




<div class="login-form-container">


<div class="login-form-page">
	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
		<div class="u-columns col2-set" id="customer_login">
			<div class="u-column1 col-1">
			<?php endif; ?>
			<h1 class="main-title">login</h1>
			<form class="woocommerce-form woocommerce-form-login login" method="post">

		

<?php //echo do_shortcode( '[nextend_social_login]' ); ?>


<div class="socal-login">
	<a href="#" class="facebook"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login-icon1.png" alt="image"></a>
	<a href="#" class="google"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login-icon2.png" alt="image"></a>
</div>

<div class="login-seperation">Or</div>

<div class="login-form-box">

                         <div class="login-title">Please enter your e-mail and password</div>

				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					
					<input placeholder="Email"  type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</div>
				<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					
					<input placeholder="password" class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</div>
				<?php do_action( 'woocommerce_login_form' ); ?>
				<div class="form-row">
					<div class="remember-forgot">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme container-check">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
							<span class="checkmark"></span> <span class="remember-text"><?php esc_html_e( 'I am not a robot', 'woocommerce' ); ?></span>
						</label>
						<a class="forgot-pass" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
							<?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?></a>
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

						</div>
					</div>

					<button type="submit" class="main-btn"  name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><span><div class="main-btn-round"></div>login</span></button>

					<?php do_action( 'woocommerce_login_form_end' ); ?>
				</form>
				<div class="new-user">
				Don't have an account? <a href="<?php echo site_url(); ?>/my-account/?action=register"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a>


				</div>	
			


				<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
				</div>

				<div class="u-column2 col-2">
					<h2 class="main-title"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
					
					<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
						<?php do_action( 'woocommerce_register_form_start' ); ?>
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
							<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<input placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?>" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</div>
						<?php endif; ?>
						<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<input placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</div>
						
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
							<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<input placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
							</div>
						<?php else : ?>
							<div><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></div>
						<?php endif; ?>
						<?php do_action( 'woocommerce_register_form' ); ?>
						<div class="woocommerce-FormRow form-row">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="btn btn-primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?><span class="icon-arrow"></button>
							</div>
							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
					</div>
				</div>
				</div>
			<?php endif; ?>
			<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
		</div>
	</div>
