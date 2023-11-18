<?php
if( class_exists('ACF') ) : 
if(get_field('quantity_field_style', 'option') == 1){/*-------Drop Down----------*/
 function woocommerce_quantity_input( $args = array(), $product = null, $echo = true ) {

   if ( is_null( $product ) ) {
    $product = $GLOBALS['product'];
  }

  $defaults = array(
    'input_id' => uniqid( 'quantity_' ),
    'input_name' => 'quantity',
    'input_value' => '1',
    'classes' => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
    'max_value' => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
    'min_value' => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
    'step' => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
    'pattern' => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
    'inputmode' => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
    'product_name' => $product ? $product->get_title() : '',
  );

  $args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );

   // Apply sanity to min/max args - min cannot be lower than 0.
  $args['min_value'] = max( $args['min_value'], 0 );
   // Note: change 20 to whatever you like
  $args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : 20;

   // Max cannot be lower than min if defined.
  if ( '' !== $args['max_value'] && $args['max_value'] < $args['min_value'] ) {
    $args['max_value'] = $args['min_value'];
  }

  $options = '';
  
  for ( $count = $args['min_value']; $count <= $args['max_value']; $count = $count + $args['step'] ) {

      // Cart item quantity defined?
    if ( '' !== $args['input_value'] && $args['input_value'] >= 1 && $count == $args['input_value'] ) {
      $selected = 'selected';      
    } else $selected = '';

    $options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';

  }

  $string = '<div class="quantity"><span>Qty</span><select name="' . $args['input_name'] . '">' . $options . '</select></div>';

  if ( $echo ) {
    echo $string;
  } else {
    return $string;
  }

}
}
if(get_field('quantity_field_style', 'option') == 2 || true){/*-------Horizontal Plus & Minus--------------*/
  add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_display_quantity_minus' );
  function bbloomer_display_quantity_minus() {
   echo '<div class="pro-quantity"><button type="button" class="minus" >-</button>';
 }
 add_action( 'woocommerce_after_add_to_cart_quantity', 'bbloomer_display_quantity_plus' );
 function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus" >+</button></div>';
 }
 add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );

 function bbloomer_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if ( ! is_product() ) return;
   ?>
   <script type="text/javascript">
    jQuery(document).ready(function($){   
     $('form.cart').on( 'click', 'button.plus, button.minus', function() {

            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));

            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
             if ( max && ( max <= val ) ) {
              qty.val( max );
            } else {
              qty.val( val + step );
            }
          } else {
           if ( min && ( min >= val ) ) {
            qty.val( min );
          } else if ( val > 1 ) {
            qty.val( val - step );
          }
        }

      });

   });
 </script>
 <?php
}
} 
if(get_field('quantity_field_style', 'option') == 3){ 
  /*-------Vertical Plus & Minus--------------*/

  /* Describe what the code snippet does so you can remember later on */
  add_action('wp_footer', 'vertical_plus_minus');
  function vertical_plus_minus(){
   ?>
   <style type="text/css">
    .quantity {
      position: relative;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button
    {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type=number]
    {
      -moz-appearance: textfield;
    }

    .quantity input {
      width: 45px;
      height: 42px;
      line-height: 1.65;
      float: left;
      display: block;
      padding: 0;
      margin: 0;
      padding-left: 20px;
      border: 1px solid #eee;
    }

    .quantity input:focus {
      outline: 0;
    }

    .quantity-nav {
      float: left;
      position: relative;
      height: 42px;
    }

    .quantity-button {
      position: relative;
      cursor: pointer;
      border-left: 1px solid #eee;
      width: 20px;
      text-align: center;
      color: #333;
      font-size: 13px;
      font-family: "Trebuchet MS", Helvetica, sans-serif !important;
      line-height: 1.7;
      -webkit-transform: translateX(-100%);
      transform: translateX(-100%);
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      user-select: none;
    }

    .quantity-button.quantity-up {
      position: absolute;
      height: 50%;
      top: 0;
      border-bottom: 1px solid #eee;
    }

    .quantity-button.quantity-down {
      position: absolute;
      bottom: -1px;
      height: 50%;
    }
    .single-product form.cart .quantity{
     border: none;
     background: none;
   }
 </style>
 <script type="text/javascript">
  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
  jQuery('.quantity').each(function() {
    var spinner = jQuery(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.quantity-up'),
    btnDown = spinner.find('.quantity-down'),
    min = input.attr('min'),
    max = input.attr('max');

    btnUp.click(function() { 
      var oldValue = parseFloat(input.val());

      if(max == ''){
        var newVal = oldValue + 1;
      }else{

        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }

      }

      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });
</script>
<?php } 
}
endif; ?>