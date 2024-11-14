=== Fast Auto Order Complete ===
Contributors: tamimh
Tags: woocommerce, auto-complete, order-processing
Requires at least: 3.0.1
Tested up to: 6.7
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A lightweight WooCommerce plugin to automatically complete orders and bypass processing email notifications.

== Description ==
A WooCommerce-based plugin that allows users to auto-complete orders without processing them and removes the processing email notification.

== Installation ==

1. Upload `fast-auto-order-complete.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure the plugin settings as needed.

== Configuration ==

To enable the auto-complete feature for each individual product:

1. Go to **Products > All Products** in WooCommerce.
2. For each product, click **Edit**.
3. In the product edit page, navigate to the **General** tab.
4. Check the "Auto Complete" checkbox to enable automatic order completion for that product.

> *Note:* Each product requires this checkbox to be selected individually to activate the auto-complete feature. This is the only functionality offered by the plugin; there are no additional settings pages or configuration options.

== Frequently Asked Questions ==

= What is the purpose of this plugin? =
This plugin allows users to auto-complete orders without processing them and removes the processing email notification.

= How do I enable the auto-complete feature for each product? =
To enable auto-complete for a product, go to **Products > All Products**, edit the product, go to the **General** tab, and check the "Auto Complete" checkbox.

== Screenshots ==

1. Screenshot of the auto-complete checkbox on the product page

== Changelog ==

= 1.0.2 =
* Updated documentation to clarify configuration steps for enabling auto-complete on individual products.

= 1.0.1 =
* Initial release of the plugin
* Added functionality to auto-complete orders without processing them
* Removed processing email notification

== Upgrade Notice ==

= 1.0.2 =
Added clarification on product-level configuration for auto-complete functionality.

= 1.0.1 =
Initial release of the plugin.

== Arbitrary section ==

This plugin uses the following hooks and filters to modify WooCommerce behavior:

* `woocommerce_product_options_general_product_data`
* `woocommerce_process_product_meta`
* `woocommerce_order_status_pending_to_processing_notification`
* `woocommerce_new_order`

These hooks and filters can be customized if needed.

== A brief Markdown Example ==

Ordered list:

1. Auto-complete orders without processing them
2. Remove processing email notification
3. Enable auto-complete per product using a checkbox in the General tab

Unordered list:

* Easy to use and configure
* Compatible with WooCommerce 3.0.1 and later
* Removes processing email notification

Here's a link to [WooCommerce](https://woocommerce.com/ "Your favorite e-commerce plugin") and one to [WordPress](http://wordpress.org/ "Your favorite software").

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up for **strong**.

`<?php code(); // goes in backticks ?>`
