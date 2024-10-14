<?php

class Fast_Auto_Order_Complete {

    public function run() {
        $this->init_hooks();
    }

    /**
     * Initializes hooks and functionality for the auto-complete feature in WooCommerce.
     */
    public function init_hooks() {
        // Add an action hook to the 'woocommerce_product_options_general_product_data' event
        add_action( 'woocommerce_product_options_general_product_data', array( $this, 'add_auto_complete_checkbox' ) );

        // Add an action hook to the 'woocommerce_process_product_meta' event
        add_action( 'woocommerce_process_product_meta', array( $this, 'save_auto_complete_checkbox' ) );

        // Remove the processing email notification when the order status changes from pending to processing
        remove_action( 'woocommerce_order_status_pending_to_processing_notification', 'WC_Email_New_Order::trigger', 10, 2 );

        // Add an action hook to the 'woocommerce_new_order' event
        add_action( 'woocommerce_new_order', array( $this, 'auto_complete_order_if_checkbox_selected' ), 10, 1 );
    }

    /**
     * Add the checkbox to the product data panel.
     */
    public function add_auto_complete_checkbox() {
        woocommerce_wp_checkbox( array(
            'id'            => 'fast_auto_order_complete_checkbox',
            'label'         => __( 'Enable Auto Complete', 'fast-auto-order-complete' ),
            'description'   => __( 'Enable this option to auto-complete the order when it is placed.', 'fast-auto-order-complete' ),
        ));
    }

    /**
     * Save the checkbox value when the product is saved.
     *
     * @param int $post_id The ID of the product.
     */
    public function save_auto_complete_checkbox( $post_id ) {
        $checkbox_value = isset( $_POST['fast_auto_order_complete_checkbox'] ) ? 'yes' : 'no';
        update_post_meta( $post_id, 'fast_auto_order_complete_checkbox', $checkbox_value );
    }

    /**
     * Auto-completes an order if the checkbox is selected for any product in the order.
     *
     * @param int $order_id The ID of the order.
     */
    public function auto_complete_order_if_checkbox_selected( $order_id ) {
        // Get the order object using the order ID
        $order = wc_get_order( $order_id );

        // Loop through the order items
        foreach ( $order->get_items() as $item_id => $item ) {
            $product_id = $item->get_product_id();
            $checkbox_value = get_post_meta( $product_id, 'fast_auto_order_complete_checkbox', true );

            // Check if the checkbox is selected for the product
            if ( 'yes' === $checkbox_value ) {
                // Update the order status to 'completed' if the checkbox is selected
                $order->update_status( 'completed', 'Order auto-completed by Fast Auto Order Complete plugin.' );
                break; // Exit loop after completing the order
            }
        }
    }
}