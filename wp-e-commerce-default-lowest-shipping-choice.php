<?php
/*
Plugin Name: WP e-Commerce Default Lowest Shipping Choice
Description: This plugin changes the checkout logic for WP e-Commerce stores so that the lowest priced shipping rate will be selected by default
Plugin URI: http://plugins.leewillis.co.uk/donate?utm_campaign=wpec-default-shipping
Author: Lee Willis
Author URI: http://www.leewillis.co.uk/
Version: 1.2
License: GPL2
*/

/*
    Copyright (C) 2014  Lee Willis  wordpress@leewillis.co.uk

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class WP_E_Commerce_Default_Lowest_Shipping_Choice {

	/**
	 * Constructor.
	 *
	 * Attach functions to filters to allow them to change the default that is chosen.
	 */
	public function __construct() {
		add_filter( 'wpsc_default_shipping_quote', array( $this, 'set_default_shipping_quote' ), 20, 2 );
	}

	/**
	 * Set the lowest shipping rate as the default.
	 *
	 * @param string     $selected_option  The currently selected rate.
	 * @param array      $shipping_quotes  Array of all available shipping quotes.
	 */
	public function set_default_shipping_quote( $selected_option, $shipping_quotes ) {
		$min = null;
		foreach ( $shipping_quotes as $key => $value ) {
			if ( is_null( $min ) || $value < $min ) {
				$min = $value;
				$selected_option = $key;
			}
		}
		return $selected_option;
	}

}

global $wp_e_commerce_default_lowest_shipping_choice;
$wp_e_commerce_default_lowest_shipping_choice = new WP_E_Commerce_Default_Lowest_Shipping_Choice();