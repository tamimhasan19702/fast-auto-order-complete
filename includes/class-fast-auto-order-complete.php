<?php

class Fast_Auto_Order_Complete
{

    public function run()
    {
        $this->init_hooks();
    }

    /**
     * Initializes hooks and functionality for the auto-complete feature in WooCommerce.
     */
    public function init_hooks()
    {
        // Add the checkbox to the product data panel
        add_action('woocommerce_product_options_general_product_data', array($this, 'add_auto_complete_checkbox'));

        // Save the checkbox value when the product is saved
        add_action('woocommerce_process_product_meta', array($this, 'save_auto_complete_checkbox'));

        // Remove the processing email notification
        add_action('woocommerce_email', array($this, 'remove_processing_email_notification'));

        // Auto-complete order if the checkbox is selected for any product in the order
        add_action('woocommerce_order_status_pending', array($this, 'auto_complete_order_if_checkbox_selected'), 10, 1);
    }

    /**
     * Add the checkbox to the product data panel.
     */
    public function add_auto_complete_checkbox()
    {
        global $post;

        // Get the current checkbox value
        $value = get_post_meta($post->ID, 'fast_auto_order_complete_checkbox', true);

        woocommerce_wp_checkbox(array(
            'id' => 'fast_auto_order_complete_checkbox',
            'label' => __('Enable Auto Complete', 'fast-auto-order-complete'),
            'description' => __('Enable this option to auto-complete the order when it is placed.', 'fast-auto-order-complete'),
            'value' => $value === 'yes' ? 'yes' : 'no', // Prepopulate the checkbox
        ));
    }

    /**
     * Save the checkbox value when the product is saved.
     *
     * @param int $post_id The ID of the product.
     */
    public function save_auto_complete_checkbox($post_id)
    {
        // Verify the nonce
        if (!isset($_POST['woocommerce_meta_nonce']) || !wp_verify_nonce($_POST['woocommerce_meta_nonce'], 'woocommerce_save_data')) {
            return;
        }

        // Save the checkbox value
        $checkbox_value = isset($_POST['fast_auto_order_complete_checkbox']) ? 'yes' : 'no';
        update_post_meta($post_id, 'fast_auto_order_complete_checkbox', $checkbox_value);
    }

    /**
     * Remove the processing email notification.
     *
     * @param WC_Email $email_class WooCommerce email class instance.
     */
    public function remove_processing_email_notification($email_class)
    {
        remove_action('woocommerce_order_status_pending_to_processing_notification', array($email_class, 'trigger'));
    }

    /**
     * Auto-complete an order if the checkbox is selected for any product in the order.
     *
     * @param int $order_id The ID of the order.
     */
    public function auto_complete_order_if_checkbox_selected($order_id)
    {
        // Get the order object using the order ID
        $order = wc_get_order($order_id);

        // Check if the order exists
        if (!$order) {
            return;
        }

        // Loop through the order items
        foreach ($order->get_items() as $item_id => $item) {
            $product_id = $item->get_product_id();
            $checkbox_value = get_post_meta($product_id, 'fast_auto_order_complete_checkbox', true);

            // Check if the checkbox is selected for the product
            if ('yes' === $checkbox_value) {
                // Update the order status to 'completed'
                $order->update_status('completed', __('Order auto-completed by Fast Auto Order Complete plugin.', 'fast-auto-order-complete'));
                return; // Exit after completing the order
            }
        }
    }
}