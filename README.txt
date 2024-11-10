=== Fast Auto Order Complete ===
Contributors: tamimh
Tags: woocommerce, auto-complete, order-processing
Requires at least: 3.0.1
Tested up to: 6.6
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A lightweight WooCommerce plugin to automatically complete orders and bypass processing email notifications.

== Description ==
A WooCommerce-based plugin that allows users to auto-complete orders without processing them and removes the processing email notification.

== Installation ==

1. Upload `fast-auto-order-complete.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin settings as needed

== Frequently Asked Questions ==

= What is the purpose of this plugin? =

This plugin allows users to auto-complete orders without processing them, and removes the processing email notification.

= How do I configure the plugin? =

You can configure the plugin settings by going to the WooCommerce settings page and clicking on the "Auto Complete" tab.

== Screenshots ==

1. Screenshot of the plugin settings page
2. Screenshot of the auto-complete checkbox on the order page

== Changelog ==

= 1.0.1 =
* Initial release of the plugin
* Added functionality to auto-complete orders without processing them
* Removed processing email notification

== Upgrade Notice ==

= 1.0.1 =
Upgrade to the latest version of the plugin to take advantage of the new features and improvements.

== Arbitrary section ==

This plugin uses the following hooks and filters to modify the WooCommerce behavior:

* `woocommerce_order_status_changed`
* `woocommerce_new_order`
* `woocommerce_order_status_pending_to_processing_notification`

You can use these hooks and filters to customize the plugin behavior to suit your needs.

== A brief Markdown Example ==

Ordered list:

1. Auto-complete orders without processing them
2. Remove processing email notification
3. Configure plugin settings as needed

Unordered list:

* Easy to use and configure
* Compatible with WooCommerce 3.0.1 and later
* Removes processing email notification

Here's a link to [WooCommerce](https://woocommerce.com/ "Your favorite e-commerce plugin") and one to [WordPress](http://wordpress.org/ "Your favorite software").

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
