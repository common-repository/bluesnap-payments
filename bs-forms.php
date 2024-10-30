<?php
/**
 * Plugin Name:       BlueSnap Payments
 * Plugin URI:        https://home.bluesnap.com/
 * Description:       Accept payments directly in your WordPress site without the need to include any additional shopping cart.
 * Version:           1.1.0
 * Author:            Bluesnap
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bs-forms
 * Domain Path:       /languages
 */
/**
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
**/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'BLF_ASSETS' ) ) {
    define( 'BLF_ASSETS', plugin_dir_url( __FILE__ ) . 'assets/' );
}

if ( ! defined( 'BLF_LOGS' ) ) {
    define( 'BLF_LOGS', plugin_dir_path( __FILE__ ) . 'logs/' );
}

if ( ! defined( 'BLF_SANDBOX_BLUESNAPDOMAINPATH' ) ) {
    define( 'BLF_SANDBOX_BLUESNAPDOMAINPATH', 'https://sandbox.bluesnap.com' );
}

if ( ! defined( 'BLF_PRODUCTION_BLUESNAPDOMAINPATH' ) ) {
    define( 'BLF_PRODUCTION_BLUESNAPDOMAINPATH', 'https://ws.bluesnap.com' );
}

if ( ! defined( 'BLF_ERROR_MESSAGE' ) ) {
    define( 'BLF_ERROR_MESSAGE', 'Your payment could not be processed. Please verify the accuracy of the data entered.' );
}

if ( ! defined( 'BLF_VALIDATE_ERROR_MESSAGE' ) ) {
    define( 'BLF_VALIDATE_ERROR_MESSAGE', 'Not all required fields were entered. Please enter the missing fields and try again.' );
}

if ( ! defined( 'BLF_KEY_ENCODE' ) ) {
    define( 'BLF_KEY_ENCODE', 'Very Very slogniy parol' );
}

if ( ! defined( 'BLF_PAYMENT_FORM_BUTTON_TEXT' ) ) {
    define( 'BLF_PAYMENT_FORM_BUTTON_TEXT', 'Checkout' );
}

if ( ! defined( 'BLF_SUBMIT_PAYMENT_BUTTON_TEXT' ) ) {
    define( 'BLF_SUBMIT_PAYMENT_BUTTON_TEXT', 'Pay' );
}

define( 'BLUESNAP_PAYMENTS_VERSION', '1.0.1' );

require_once('includes/postTypes.php');

require_once('includes/pluginSettings.php');

require_once('includes/class.blf-admin.php');

require_once('includes/shortcodes.php');

new BLF_Admin();