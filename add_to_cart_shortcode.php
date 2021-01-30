<?php

/**
 *  Plugin Name: Add to cart ShortCode
 *  Description: Add to cart plugin
 *  Version: 1.3
 *  Author: Loïc NOGIER
 *  License: MIT
 */


if (!defined('WPINC') || !defined('ABSPATH')) {
    die();
}

define('ADD_TO_CART_VERSION', '1.3');

if( ! function_exists( 'add_to_cart_shortcode' ) ) {
    function add_to_cart_shortcode( $attributes = array() ) {

        $a = shortcode_atts( array(
            'product_id' => '0',
            'title_text' => 'Add to cart',
        ), $attributes, 'product_add_to_cart_form' );


        wp_enqueue_script(
            'add_to_cart',
            plugin_dir_url(__FILE__) . 'public/js/script.js',
            [],
            ADD_TO_CART_VERSION,
            false
        );

        ob_start();
        ?>
        <div class="add_to_cart_shortcode_form add-to-cart-pro simple" data-cart_product_id="<?= $a['product_id'] ?>" >
            <input class="input-text qty text" type="number" step="1" size="4" min="1" value="1" pattern="[0-9]*" inputmode="numeric">

            <a
                href="?add-to-cart=<?= $a['product_id'] ?>"
                data-quantity="1"
                data-product_id="<?= $a['product_id'] ?>"
                data-product_sku=""
                class="button product_type_simple add_to_cart_button ajax_add_to_cart added"
                rel="nofollow"
                aria-label=""
            ><?= $a['title_text'] ?></a>
        </div>
        <?php
        return ob_get_clean();

    }
}
if (!is_admin()) {
    add_shortcode( 'add_to_cart_shortcode', 'add_to_cart_shortcode' );
}