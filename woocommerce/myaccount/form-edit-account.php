<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); 

$user_id = get_current_user_id();
?>




<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
<div class="myaccount-title">
	<h2><?php _e('Account Information'); ?></h2>
	</div>
	<!-- <div class="woocommerce-myaccount-leftside"> -->

		<!-- <div class="main-account-information-form"> -->

		
			
			
			<fieldset class="change-account-details">
				<h3><?php _e('Edit personal information'); ?></h3>
				<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

				<p class="form-row">
					<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required"></span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="" />
				</p>
				<p class="form-row">
					<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required"></span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="" />
				</p>

				<p class="form-row">
					<label for="billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="billing_phone" value="" />
				</p>

				<p class="form-row">
					<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required"></span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="" />
				</p>
				<?php do_action( 'woocommerce_edit_account_form' ); ?>

				<p>
				<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
				<button type="submit" class="woocommerce-Button btn btn-primary" name="save_account_details" value="<?php esc_attr_e( 'Update', 'woocommerce' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
				<input type="hidden" name="action" value="save_account_details" />
			</p>

			</fieldset>






			<fieldset class="change-password-set">
				<h3><?php esc_html_e( 'Change Password', 'woocommerce' ); ?></h3>

				<div class="change-password-set-inner"> 

					<p class="form-row">
						<label for="password_current"><?php esc_html_e( 'Current password', 'woocommerce' ); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
					</p>
					<p class="form-row">
						<label for="password_1"><?php esc_html_e( 'New password', 'woocommerce' ); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
					</p>
					<p class="form-row">
						<label for="password_2"><?php esc_html_e( 'Confirm password', 'woocommerce' ); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
					</p>
				</div>
				<p>
				<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Update', 'woocommerce' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
				<input type="hidden" name="action" value="save_account_details" />
			</p>
			</fieldset>




			<?php do_action( 'woocommerce_edit_account_form_end' ); ?>


		<!-- </div> -->
	<!-- </div> -->


</form>
<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
