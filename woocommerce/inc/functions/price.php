<?php 
add_filter('woocommerce_currency_symbol', 'my_currency_symbol', 10, 2); // Currency Symbol
add_action( 'woocommerce_before_single_product', 'move_single_price', 1 ); // move price position in detail page
add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format', 10, 2 ); //Variable Product Price Range: "From: <del>$$$min_reg_price</del> $$$min_sale_price"
add_filter( 'woocommerce_get_price_html', 'change_product_price_html', 10, 2 ); // Change the shop / product prices if a unit_price is set
add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3); //custon sale tag
add_filter( 'woocommerce_get_price_html', 'text_after_price' ); // text after price

// Currency Symbol

function my_currency_symbol( $currency_symbol, $currency ) {

 switch( $currency ) {

  case 'AED': $currency_symbol = 'AED '; 

  break;

}

return $currency_symbol;

}





function replace_single_price(){

  global $product, $post;

  $price_html = $product->get_price_html();

  $product_id = $product->get_id();

  $flash_sale = woocommerce_custom_sales_price($product->price, $product);

  if($product->get_sku() !=''){

    echo '<div class="product-sku"><p>SKU: '.$product->get_sku().'</p> </div>';

  }

  ?>

  <?php if(get_field('shipping_note') !=''){ ?><span class="shipping-note"><?php the_field('shipping_note'); ?></span><?php } ?>



  <?php 





  echo '<div class="text-block-01"><div class="detail-price">'.$price_html.'</div>';





}





// move price position in detail page

function move_single_price(){

  global $product, $post;



     // removing the variations price for variable products

  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

     //remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );





  if ( $product->is_type( 'variable' ) ) {

        // Change location and inserting back the variations price

    add_action( 'woocommerce_single_product_summary', 'replace_variation_single_price', 10 );

  }else{

    add_action( 'woocommerce_single_product_summary', 'replace_single_price', 10);

  }

}



function replace_variation_single_price(){

  global $product;



    // Main Price

  $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );

  $price = $prices[0] !== $prices[1] ? sprintf( __( ' %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );


    // Sale Price

  $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );

  sort( $prices );

  $saleprice = $prices[0] !== $prices[1] ? sprintf( __( ' %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );



  $flash_sale = woocommerce_custom_sales_price($price, $product);

  if($product->get_sku() !=''){

   // echo '<div class="product-sku"><p>SKU: '.$product->get_sku().'</p> </div>';

  }

// echo do_shortcode('[site_reviews_summary hide="bars,rating" assigned_to="post_id" class="owl-carousel owl-theme"]');

  $rating_count = $product->get_rating_count();

  $review_count = $product->get_review_count();

  $average      = $product->get_average_rating();

  //echo wc_get_rating_html( $average, $rating_count );



  ?>

  <?php 



  if ( $price !== $saleprice && $product->is_on_sale() ) {

    $price_html = '<del>' . $saleprice . $product->get_price_suffix() . '</del><ins>' . $price . $product->get_price_suffix() . '</ins>';

  }else{

    $price_html = '<ins>' . $price . $product->get_price_suffix() . '</ins>';

  }



  //  $price_html = $product->get_price_html();





    $term_list = get_the_terms( $product->get_id(), 'product_cat' ); //echo "<pre style='display:none;'>"; print_r($term_list); echo "</pre>";

    $term = $term_list[0];



    if(wp_strip_all_tags(wc_price( $prices[0])) != '0.00'){ 

      $price = $price_html; 

    }else{ 

      $price = ''; 

    } 



    // echo '<div class="detail-price"><div class="price">'.$price.'</div></div>';







    ?>

    <style>

      div.woocommerce-variation-price,

      div.woocommerce-variation-availability,

      div.hidden-variable-price {

        height: 0px !important;

        overflow:hidden;

        position:relative;

        line-height: 0px !important;

        font-size: 0% !important;

      }

    </style>

    <script>

      jQuery(document).ready(function($) {

       $('input.variation_id').change( function(){ 

        if( '' != $('input.variation_id').val() ){

         if($('span.availability'))

          $('span.availability').remove();

        $('div.price').html($('div.woocommerce-variation-price > span.price').html());

        $('.single-product .product_meta').after('<span class="availability">'+$('div.woocommerce-variation-availability').html()+'</span>');

            //console.log($('input.variation_id').val());

           // console.log($('div.woocommerce-variation-price > span.price').html());

         } else {

          $('div.price').html($('div.hidden-variable-price').html());

          if($('span.availability'))

           $('span.availability').remove();

        //console.log('NULL');

      }

      if($(".price del").length){

        var currency   = ' <?php echo get_woocommerce_currency_symbol(); ?>',

        del_price       = jQuery('.detail-price .price del .amount').text().replace(/ /g,'').replace('AED','').replace(',',''),

        ins_price       = jQuery('.detail-price .price ins .amount').text().replace(/ /g,'').replace('AED','').replace(',',''),

        parseDelPrice  = parseFloat(del_price),

        parseInsPrice  = parseFloat(ins_price);

        //totalPrice  = parsePrice.toFixed(2) + currency;



        var percentage = ((del_price - ins_price)/del_price)*100;

        jQuery('.single-product .detail-price .offer-price .sale-tag').remove();

        jQuery('.detail-price .price del').after('&nbsp;<span class="sale-tag">-'+percentage.toFixed(0)+'%<span>');





      }





    });

     });

   </script>



   <?php



   echo '<div class="text-block-01"><div class="detail-price"><div class="price">'.$price.'</div><div class="hidden-variable-price" >'.$price.'</div></div>';



 }





//Direct call- Variable Product Price Range: "From: <del>$$$min_reg_price</del> $$$min_sale_price"

 function bbloomer_variation_price_format_min( $price, $product ) {

   $prices = $product->get_variation_prices( true );

   $min_price = current( $prices['price'] );



   $term_list = get_the_terms( $product->get_id(), 'product_cat' );

   $term = $term_list[0];



   $price = sprintf( __( '<label>From: </label> %1$s', 'woocommerce' ), wc_price( $min_price ) );

   return $price;

 }



/**

 * @snippet       Variable Product Price Range: "From: <del>$$$min_reg_price</del> $$$min_sale_price"

 * @how-to        Get CustomizeWoo.com FREE

 * @sourcecode    https://businessbloomer.com/?p=275

 * @author        Rodolfo Melogli

 * @compatible    WooCommerce 3.5.4

 * @donate $9     https://businessbloomer.com/bloomer-armada/

 */





function bbloomer_variation_price_format( $price, $product ) {



// 1. Get min/max regular and sale variation prices



  $min_var_reg_price = $product->get_variation_regular_price( 'min', true );

  $min_var_sale_price = $product->get_variation_sale_price( 'min', true );

  $max_var_reg_price = $product->get_variation_regular_price( 'max', true );

  $max_var_sale_price = $product->get_variation_sale_price( 'max', true );



// 2. New $price, unless all variations have exact same prices



  if ( ! ( $min_var_reg_price == $max_var_reg_price && $min_var_sale_price == $max_var_sale_price ) ) {   

   if ( $min_var_sale_price < $min_var_reg_price ) {

    $price = sprintf( __( '<label>From: </label> <del>%1$s</del><ins>%2$s</ins>', 'woocommerce' ), wc_price( $min_var_reg_price ), wc_price( $min_var_sale_price ) );

  } else {

    $price = sprintf( __( '<label>From: </label> %1$s', 'woocommerce' ), wc_price( $min_var_reg_price ) );

  }

}



// 3. Return $price



return $price;

}




// only copy the opening php tag if needed

// Change the shop / product prices if a unit_price is set

function change_product_price_html( $price_html, $product ) {

  global $product;



  if($product->product_type == 'simple'){



   $flash_sale = woocommerce_custom_sales_price($product->price, $product);


     $price_incl_tax = wc_get_price_including_tax( $product ); // price with VAT

     $price_excl_tax =  $product->get_price_excluding_tax();


     $term_list = get_the_terms( $product->get_id(), 'product_cat' );

     $term = $term_list[0];

     if ($product->is_on_sale()){

      $regular_price = wc_get_price_including_tax($product,array('price'=>$product->get_regular_price())) ;

      $regular_price_excl_tax = $product->get_regular_price();

      if(number_format($regular_price, 2) == '0.00'){

        $price_html = '';

      }else{



       if (is_front_page() || is_shop() || is_product_category()) {

        $price_html = '<div class="price"><ins> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol(). ' </span>'.number_format( $price_excl_tax, 2).'</span></ins><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol(). ' </span>' .number_format( $regular_price_excl_tax, 2) .'</span></del></div>';

      } else {

        $price_html = '<div class="price"><ins> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol(). ' </span>'.number_format( $price_excl_tax, 2).'</span></ins><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol(). ' </span>' .number_format( $regular_price_excl_tax, 2) .'</span></del></div>';

      }





    }





  }else{





    if(number_format($price_excl_tax, 2) == '0.00'){

      $price_html = '';

    }else{

      if (is_front_page() || is_shop() || is_product_category()) {

       $price_html = '<div class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><span class="currency">'.get_woocommerce_currency_symbol().'</span> </span>'.number_format($price_excl_tax, 2).'</span></ins></div>';

     } else {

      $price_html = '<div class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><span class="currency">'.get_woocommerce_currency_symbol().'</span> </span>'.number_format($price_excl_tax, 2).'</span></ins></div>';

    }



  }



} 



}else{





}





return $price_html;



}







function woocommerce_custom_sales_price( $price, $product ) {



  if ($product->is_on_sale() && $product->product_type == 'variable') :



    $available_variations = $product->get_available_variations();               

    $maximumper = 0;

    for ($i = 0; $i < count($available_variations); ++$i) {

      $variation_id=$available_variations[$i]['variation_id'];

      $variable_product1= new WC_Product_Variation( $variation_id );

      $regular_price = $variable_product1 ->regular_price;

      $sales_price = $variable_product1 ->sale_price;

      if($sales_price !=''){

        $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;

        if ($percentage > $maximumper) {

          $maximumper = $percentage;

        }

      }

    }



    return sprintf( __(' <span class="sale-tag">Sale %s</span>', 'woocommerce' ), $maximumper . '%' );



  elseif($product->is_on_sale() && $product->product_type == 'simple') : 





    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );

    return sprintf( __(' <span class="sale-tag">Sale %s</span>', 'woocommerce' ), $percentage . '%' );



  endif;





}





//custon sale tag

function woocommerce_custom_sale_text($text, $post, $product){



  if ($product->is_on_sale() && $product->product_type == 'variable') :



    $available_variations = $product->get_available_variations();               

    $maximumper = 0;

    for ($i = 0; $i < count($available_variations); ++$i) {

      $variation_id=$available_variations[$i]['variation_id'];

      $variable_product1= new WC_Product_Variation( $variation_id );

      $regular_price = $variable_product1 ->regular_price;

      $sales_price = $variable_product1 ->sale_price;

      $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;

      if ($percentage > $maximumper) {

        $maximumper = $percentage;

      }

    }

    echo $price . sprintf( __('<span class="sale-tag">On Sale</span>', 'woocommerce' ), $maximumper . '%' );



  elseif($product->is_on_sale() && $product->product_type == 'simple') : 





    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );

    echo $price . sprintf( __('<span class="sale-tag">Sale %s</span>', 'woocommerce' ), $percentage . '%' ); 



  endif;



  

}





// text after price

function text_after_price($price){

  if(is_product()){
	  global $product; 
	  $weight_unit = get_option('woocommerce_weight_unit');
	  $weight = $product->get_weight();
	  $text_to_add_after_price = '';
	  if( $weight !=''){
		
      $text_to_add_after_price  =  '<div class="pro-att"><span class="pro-flavour">'.get_the_term_list( $product->get_id(), 'flavours','','  - ').'</span> - <span class="pro-weight">'.$weight.''. $weight_unit.'</span></div>';
	  }

    return $price .   $text_to_add_after_price;

  }else{

    return $price;

  }



} 