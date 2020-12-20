

    
add_filter( 'wc_add_to_cart_message_html', 'bbloomer_custom_add_to_cart_message' );
 
function bbloomer_custom_add_to_cart_message() {
 
global $woocommerce;
$return_to  = get_permalink(woocommerce_get_page_id('shop'));
$message    = sprintf('<a href="%s" class="button wc-forwards">%s</a> %s', $return_to, __('Torna al catalogo', 'woocommerce'), __('Articolo aggiunto correttamente. Clicca sulla foto per ordinarne un altro oppure cerca un altro articolo', 'woocommerce') );
return $message;
}

add_filter( 'woocommerce_currencies', 'add_my_currency' );

function add_my_currency( $currencies ) {
     $currencies['ABC'] = __( 'Grammi', 'woocommerce' );
     return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'ABC': $currency_symbol = 'gr'; break;
     }
     return $currency_symbol;
}


add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 80 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 9;
  return $cols;
}


add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' );    // < 2.1

function woo_custom_cart_button_text() {
 
        return __( 'Ordina', 'woocommerce' );
  
}

add_filter( 'wpo_wcpdf_filename', 'wpo_wcpdf_custom_filename', 10, 4 );
function wpo_wcpdf_custom_filename( $filename, $template_type, $order_ids, $context ) {
    $invoice_string = _n( 'invoice', 'invoices', count($order_ids), 'woocommerce-pdf-invoices-packing-slips' );
    $new_prefix = _n( 'order', 'orders', count($order_ids), 'woocommerce-pdf-invoices-packing-slips' );
    $new_filename = str_replace($invoice_string, $new_prefix, $filename);
 
    return $new_filename;
}
