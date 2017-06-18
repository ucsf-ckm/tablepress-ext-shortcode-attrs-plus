<?php

/**
 * @link              https://github.com/ucsf-ckm/tablepress-ext-shortcode-attrs-plus
 * @since             1.0.0
 * @package           TablePressExtShortcodeAttrsPlus
 *
 * @wordpress-plugin
 * Plugin Name:       TablePress Extension: Shortcode Attributes Plus
 * Plugin URI:        https://github.com/ucsf-ckm/tablepress-ext-shortcode-attrs-plus
 * Description:       Provides additional attributes to the [table /] shortcode.
 * Version:           0.9.0
 * Author:            Stefan Topfstedt
 * Author URI:        https://github.com/stopfstedt
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * GitHub Plugin URI: https://github.com/ucsf-ckm/tablepress-ext-shortcode-attrs-plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'tablepress_datatables_parameters', 'tablepress_ext_shortcode_attrs_plus_datatables_parameters', 10, 5 );
add_filter( 'tablepress_shortcode_table_default_shortcode_atts', 'tablepress_ext_shortcode_attrs_plus_shortcode_table_default_shortcode_atts' );
add_filter( 'tablepress_table_js_options', 'tablepress_ext_shortcode_attrs_plus_js_options', 10, 3 );


/**
 * Defines additional attributes to be used with the [table /] Shortcode.
 *
 * @since 1.0
 *
 * @param array $default_atts Default attributes for the [table /] shortcode.
 *
 * @return array Extended attributes for the Shortcode.
 */
function tablepress_ext_shortcode_attrs_plus_shortcode_table_default_shortcode_atts( $default_atts ) {
	$default_atts['invisible-columns'] = '';
	$default_atts['hide-search-box']   = false;

	return $default_atts;
}

/**
 * Adds column definitions and DOM overrides to the data-table config parameters, if applicable.
 *
 * @since 1.0.0
 *
 * @param array $parameters The parameters for the DataTables JS library.
 * @param string $table_id The current table ID.
 * @param string $html_id The ID of the table HTML element.
 * @param array $js_options The options for the JS library.
 *
 * @return array the modified parameters array.
 */
function tablepress_ext_shortcode_attrs_plus_datatables_parameters( $parameters, $table_id, $html_id, $js_options ) {
	// define columns as invisible
	$invisible_columns = array();
	if ( '' !== trim( $js_options['invisible_columns'] ) ) {
		$invisible_columns = array_map( function ( $value ) {
			return intval( trim( $value ), 10 );
		}, explode( ',', $js_options['invisible_columns'] ) );
	}
	if ( ! empty( $invisible_columns ) ) {
		$column_definitions = array(
			array(
				"targets" => $invisible_columns,
				"visible" => false,
			)
		);
		$parameters[]       = '"columnDefs": ' . json_encode( $column_definitions );
	}

	// remove search box from DOM definition
	$hide_search_box = filter_var( $js_options['hide_search_box'], FILTER_VALIDATE_BOOLEAN );
	if ( $hide_search_box ) {
		$parameters[] = '"sDom": "<\"H\"lr>t<\"F\"ip>"';
	}

	return $parameters;
}


/**
 * Pass shortcode attributes to JavaScript arguments.
 *
 * @since 1.0
 *
 * @param array $js_options Current JS options.
 * @param string $table_id Table ID.
 * @param array $render_options Render Options.
 *
 * @return array Modified JS options.
 */
function tablepress_ext_shortcode_attrs_plus_js_options( $js_options, $table_id, $render_options ) {
	$js_options['invisible_columns'] = $render_options['invisible-columns'];
	$js_options['hide_search_box']   = $render_options['hide-search-box'];

	return $js_options;
}
