<?php
/**
* Plugin Name: Storms WooCommerce PagSeguro Fields API
* Plugin URI: https://github.com/vinigarcia87/storms-woocommerce-pagseguro-fields-api
* Description: Adiciona campos da PagSeguro na API WooCommerce
* Author: Storms Websolutions - Vinicius Garcia
* Author URI: http://storms.com.br/
* Version: 1.0
* License: GPLv2 or later
*
* WC requires at least: 3.9.2
* WC tested up to: 3.9.2
*
* Text Domain: storms
* Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	include_once __DIR__ . '/class-storms-wc-pagseguro-order-api.php';
	(new Storms_WC_PagSeguro_Order_API())->register();

}
