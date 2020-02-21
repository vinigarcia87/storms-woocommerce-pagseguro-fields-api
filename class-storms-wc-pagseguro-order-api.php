<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * Storms_WC_PagSeguro_Order_API class
 * Adiciona os campos da PagSeguro nas Orders do WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Storms_WC_PagSeguro_Order_API
{
	public function register() {
		add_action( 'rest_api_init', array( $this, 'register_pagseguro_order_meta_fields' ), 100 );
	}

	/**
	 * Register PagSeguro order meta fields in WP REST API.
	 */
	public function register_pagseguro_order_meta_fields() {

		if ( ! function_exists( 'register_rest_field' ) ) {
			return;
		}

		register_rest_field( 'shop_order',
			'pagseguro_transaction_id',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'PagSeguro Transaction ID', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

		register_rest_field( 'shop_order',
			'pagseguro_payer_email',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'Payer email', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

		register_rest_field( 'shop_order',
			'pagseguro_payer_name',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'Payer name', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

		register_rest_field( 'shop_order',
			'pagseguro_payment_type',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'Payment type', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

		register_rest_field( 'shop_order',
			'pagseguro_payment_method',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'Payment method', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

		register_rest_field( 'shop_order',
			'pagseguro_installments',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'Installments', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

		register_rest_field( 'shop_order',
			'pagseguro_payment_url',
			array(
				'get_callback'    => array( $this, 'get_pagseguro_meta_fields_callback' ),
				'update_callback' => array( $this, 'update_pagseguro_meta_fields_callback' ),
				'schema'          => array(
					'description' => __( 'Payment URL', 'woocommerce-pagseguro' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

	}

	//<editor-fold desc="PagSeguro Meta Fields">

	/**
	 * Get transaction id callback.
	 *
	 * @param array           $data    Details of current response.
	 * @param string          $field   Name of field.
	 * @param \WP_REST_Request $request Current request.
	 *
	 * @return string
	 */
	public function get_pagseguro_meta_fields_callback( $data, $field, $request ) {
		$meta_field = '';
		switch ($field) {
			case 'pagseguro_transaction_id':
				$order = wc_get_order( $data['id'] );
				return $order->get_transaction_id();
				break;
			case 'pagseguro_payer_email':
				$meta_field = __( 'Payer email', 'woocommerce-pagseguro' );
				break;
			case 'pagseguro_payer_name':
				$meta_field = __( 'Payer name', 'woocommerce-pagseguro' );
				break;
			case 'pagseguro_payment_type':
				$meta_field = __( 'Payment type', 'woocommerce-pagseguro' );
				break;
			case 'pagseguro_payment_method':
				$meta_field = __( 'Payment method', 'woocommerce-pagseguro' );
				break;
			case 'pagseguro_installments':
				$meta_field = __( 'Installments', 'woocommerce-pagseguro' );
				break;
			case 'pagseguro_payment_url':
				$meta_field = __( 'Payment URL', 'woocommerce-pagseguro' );
				break;
		}

		return get_post_meta( $data['id'], $meta_field, true );
	}

	/**
	 * Update pagseguro meta fields callback.
	 *
	 * @param string  $value  The value of the field.
	 * @param \WP_Post $object The object from the response.
	 *
	 * @return bool
	 */
	public function update_pagseguro_meta_fields_callback( $value, $object ) {
		if ( ! $value || ! is_string( $value ) ) {
			return false;
		}

		// We don't let the ERP change this!
		return false;
	}

	//</editor-fold>

}
