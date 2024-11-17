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
        // Add a checkbox to the product data panel
        add_action('woocommerce_product_options_general_product_data', array($this, 'add_auto_complete_checkbox'));

        // Save the checkbox value when the product is saved
        add_action('woocommerce_process_product_meta', array($this, 'save_auto_complete_checkbox'));

        // Remove "processing" email notifications
        remove_action('woocommerce_order_status_pending_to_processing_notification', array('WC_Email_New_Order', 'trigger'));
        remove_action('woocommerce_order_status_pending_to_processing_notification', array('WC_Email_Customer_Processing_Order', 'trigger'));

        // Auto-complete orders if the checkbox is enabled
        add_action('woocommerce_thankyou', array($this, 'auto_complete_order_if_checkbox_selected'), 10, 1);
    }

    /**
     * Add the checkbox to the product data panel.
     */
    public function add_auto_complete_checkbox()
    {
        global $post;

        // Retrieve the saved value for the checkbox
        $value = get_post_meta($post->ID, '_fast_auto_order_complete_checkbox', true);

        // Add the checkbox to the product data panel
        woocommerce_wp_checkbox(array(
            'id' => 'fast_auto_order_complete_checkbox',
            'label' => __('Enable Auto Complete', 'fast-auto-order-complete'),
            'description' => __('Enable this option to auto-complete the order when it is placed.', 'fast-auto-order-complete'),
            'value' => $value, // Set the saved value
        ));
    }

    /**
     * Save the checkbox value when the product is saved.
     *
     * @param int $post_id The ID of the product.
     */
    public function save_auto_complete_checkbox($post_id)
    {
        // Check if nonce is set
        if (!isset($_POST['woocommerce_meta_nonce'])) {
            return;
        }

        // Unsanitize nonce before validation
        $nonce = sanitize_text_field(wp_unslash($_POST['woocommerce_meta_nonce']));

        // Verify nonce for security
        if (!wp_verify_nonce($nonce, 'woocommerce_save_data')) {
            return;
        }

        // Sanitize the checkbox value and save to the database
        $checkbox_value = isset($_POST['fast_auto_order_complete_checkbox']) ? 'yes' : 'no';
        update_post_meta($post_id, '_fast_auto_order_complete_checkbox', $checkbox_value);
    }

    /**
     * Auto-completes an order if the checkbox is selected for any product in the order.
     *
     * @param int $order_id The ID of the order.
     */
    public function auto_complete_order_if_checkbox_selected($order_id)
    {
        // Get the order object using the order ID
        $order = wc_get_order($order_id);

        // Check if any product in the order has the checkbox enabled
        foreach ($order->get_items() as $item) {
            $product_id = $item->get_product_id();
            $checkbox_value = get_post_meta($product_id, '_fast_auto_order_complete_checkbox', true);

            // If checkbox is enabled, auto-complete the order
            if ('yes' === $checkbox_value) {
                // Set the order status to completed
                $order->update_status('completed', 'Order auto-completed by Fast Auto Order Complete plugin.');

                // Trigger the "order completed" email notification
                $mailer = WC()->mailer();
                $mailer->emails['WC_Email_Customer_Completed_Order']->trigger($order_id);

                break; // Exit the loop after completing the order
            }
        }
    }
}