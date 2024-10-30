<?php
/*
 * Plugin Name: Book Previewer
 * Plugin URI: http://www.wzymedia.com
 * Description: Retrieves and displays Google Books previews for titles you choose in any WordPress page or post.
 * Version: 1.0.6
 * Author: WZY
 * Author URI: http://www.wzymedia.com
 * License: GPL3
 * Text Domain: bookpreviewer
 * Domain Path: /lang/
 */

/*  
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// error_reporting(E_ALL);

defined('ABSPATH') or die("Incorrect path");

// Load plugin files and configuration
$jhbpplugin = plugin_basename(__FILE__); 
$jhbpppath = plugin_dir_path(__FILE__);
$jhbpppath .= '/jhbpclasses.php';
include_once($jhbpppath);

$jhbpobj  = new jhbookpreviewer;

$jhbpobj->jhbploadlocal();
if (is_admin()) {
    add_action('admin_init', array(&$jhbpobj, 'jhbpregistersettings'));
    add_action('admin_menu', array(&$jhbpobj, 'jhbpaddadminpage'));
    add_action('admin_notices', array(&$jhbpobj, 'jhbpshownotices'));
    add_filter("plugin_action_links_$jhbpplugin", array(&$jhbpobj, 'jhbpoptionslink'));
    add_filter('plugin_row_meta', array(&$jhbpobj,'jhbpdonatelink'), 10, 2);
}

$jhbpobj->jhbpaddactions();
?>