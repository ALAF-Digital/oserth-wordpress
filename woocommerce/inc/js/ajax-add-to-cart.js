jQuery(document).ready(function($) {

	$('.single_add_to_cart_button_ajax').on('click', function(e){ 

		e.preventDefault();

		$thisbutton = $(this),

			$form = $thisbutton.closest('form.cart'),

			id = $thisbutton.val(),

			product_qty = $form.find('input[name=quantity]').val() || 1,

			product_id = $form.find('input[name=product_id]').val() || id,

			variation_id = $form.find('input[name=variation_id]').val() || 0;

		var data = {

			action: 'ql_woocommerce_ajax_add_to_cart',

			product_id: product_id,

			product_sku: '',

			quantity: product_qty,

			variation_id: variation_id,

		};

		$.ajax({

			type: 'post',

			url: window.location.origin+"/wp-admin/admin-ajax.php",

			data: data,

			beforeSend: function (response) { // console.log(response);

				$thisbutton.removeClass('added').addClass('loading');

			},

			complete: function (response) { //console.log(response)

				$thisbutton.addClass('added').removeClass('loading');

			}, 

			success: function (response) { //console.log(response)

				window.scrollTo(0, 100);

				if (response.error & response.product_url) {

					window.location = response.product_url;

					return;

				} else { //console.log(2)

					var n1 = parseInt(product_qty);

					var n2 = parseInt(jQuery('.item-count').html());

					var r = n1 + n2;

					jQuery('.item-count').html(r);

					jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);

					if(product_qty == 1){

						jQuery('.woocommerce-notices-wrapper').html('<div class="woocommerce-message" role="alert"><a href="'+window.location.origin+'/cart/" tabindex="1" class="button wc-forward">View cart</a> “'+jQuery(this).find('.woocommerce-loop-product__title').html()+'” has been added to your cart.</div></div>');

					}else{

						jQuery('.woocommerce-notices-wrapper').html('<div class="woocommerce-message" role="alert"><a href="'+window.location.origin+'/cart/" tabindex="1" class="button wc-forward">View cart</a> '+product_qty+' X “'+jQuery(this).find('.woocommerce-loop-product__title').html()+'” has been added to your cart.</div></div>');

					}
					
					
					 setTimeout(function() {
						jQuery(".woocommerce-notices-wrapper").fadeOut('slow');
					  }, 5000);

					//window.location = window.location.href;

				} 

			}, 

		}); 

	}); 

	$('.product_add_to_cart_button_ajax').on('click', function(e){

		e.preventDefault();

		$thisbutton = $(this),

			id = $thisbutton.data('product_id'),

			product_qty =  $thisbutton.data('quantity'),

			product_id =id,

			variation_id =0;

		// console.log(id);

		var data = {

			action: 'ql_woocommerce_ajax_add_to_cart',

			product_id: product_id,

			product_sku: '',

			quantity: product_qty,

			variation_id: variation_id,

		};



		$.ajax({

			type: 'post',

			url: window.location.origin+"/wp-admin/admin-ajax.php",

			data: data,

			beforeSend: function (response) { // console.log(response);

				$thisbutton.removeClass('added').addClass('loading');

			},

			complete: function (response) { //console.log(response)

				$thisbutton.addClass('added').removeClass('loading');

			}, 

			success: function (response) { //console.log(response)

				window.scrollTo(0, 100);

				if (response.error & response.product_url) {

					window.location = response.product_url;

					return;

				} else { //console.log(2)

					var n1 = parseInt(product_qty);

					var n2 = parseInt(jQuery('.item-count').html());

					var r = n1 + n2;

					jQuery('.item-count').html(r);

					jQuery().trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);

					jQuery('.remove-'+id).trigger('click');

					if(product_qty == 1){

						jQuery('.woocommerce-notices-wrapper').html('<div class="woocommerce-message" role="alert"><a href="'+window.location.origin+'/cart/" tabindex="1" class="button wc-forward">View cart</a> “'+$thisbutton.data('product_name')+'” has been added to your cart.</div></div>');

					}else{

						jQuery('.woocommerce-notices-wrapper').html('<div class="woocommerce-message" role="alert"><a href="'+window.location.origin+'/cart/" tabindex="1" class="button wc-forward">View cart</a> '+product_qty+' X “'+$thisbutton.data('product_name')+'” has been added to your cart.</div></div>');

					}

 					 setTimeout(function() {
						jQuery(".woocommerce-notices-wrapper").fadeOut('slow');
					  }, 5000);
					
					//window.location = window.location.href;

				} 

			}, 

		}); 

	}); 

	
	$('.add-more-quantity').on('click', function(e){

		$thisbutton = $(this);

		var product_id = $thisbutton.data('product_id');
		
		console.log(product_id);

		var productItem = jQuery('li.item-'+product_id+' .product_add_to_cart_button_ajax');

		var product_qty =  productItem.attr('data-quantity');

		var n1 = parseInt(product_qty);

		var n2 = parseInt(1);

		var r = n1 + n2;

		productItem.attr('data-quantity', r);
		var productItem = jQuery('li.item-'+product_id+' .add-more-quantity.plus').html(r);

		return false;

	}); 

});