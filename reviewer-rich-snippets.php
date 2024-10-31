<?php
/**
 * Plugin Name: 	Reviewer Rich Snippets
 * Plugin URI:
 * Description:     Add rich snippet mark-up data to your reviews
 * Version: 		1.0.0
 * Author: 			Jeroen Sormani
 * Author URI: 		http://jeroensormani.com/
 * Text Domain: 	reviewer-rich-snippets
 *
 * Copyright 2016 - Jeroen Sormani
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( version_compare( PHP_VERSION, '5.3', 'lt' ) ) {
	return;
}

define( 'REVIEWER_RICH_SNIPPETS_FILE', __FILE__ );
require 'class-reviewer-rich-snippets.php';
