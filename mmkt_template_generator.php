<?php
/*
Plugin Name: MMKT Template Generator
Plugin URI: http://brunno.me/plugins/mmkt_template_generator
Description: Simple plugin to generate MMKT friendly HTML with your favorite posts.
Version: 0.1
Author: squiter
Author URI: http://brunno.me
License: GPL2
*/

/*  Copyright 2011  Brunno dos Santos  (email : brunno@brunno.me)

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

/* Let's code guys */

if (!defined('MTG_PLUGIN_BASENAME')) {
  //mmkt_template_generator/mmkt_template_generator.php
  define('MTG_PLUGIN_BASENAME', plugin_basename(__FILE__));
}
if (!defined('MTG_PLUGIN_NAME')) {
  //mmkt_template_generator
  define('MTG_PLUGIN_NAME', trim(dirname(MTG_PLUGIN_BASENAME), '/'));
}
if (!defined('MTG_NAME')) {
  define('MTG_NAME', 'MMKT Template Generator');
}
if (!defined('MTG_TEXTDOMAIN')) {
  define('MTG_TEXTDOMAIN', 'mtg');
}
if (!defined('MTG_PLUGIN_DIR')) {
  // /path to wordpress/wp-content/plugins/mmkt_template_generator
  define('MTG_PLUGIN_DIR', dirname(__FILE__));
}
if (!defined('MTG_PLUGIN_URL')) {
  // http://www.domain.com/wordpress/wp-content/plugins/mmkt_template_generator
  define('MTG_PLUGIN_URL', WP_PLUGIN_URL . '/' . MTG_PLUGIN_NAME);
}
if (!defined('MTG_PLUGIN_ASSETS_URL')) {
  // http://www.domain.com/wordpress/wp-content/plugins/mmkt_template_generator/assets
  define('MTG_PLUGIN_ASSETS_URL', WP_PLUGIN_URL . '/' . MTG_PLUGIN_NAME . '/assets');
}
if (!defined('MTG_CONFIG_PAGE')) {
  define('MTG_CONFIG_PAGE', "mtg-config");
}
if (!defined('MTG_EDITIONS_PAGE')) {
  define('MTG_EDITIONS_PAGE', "mtg-templates");
}
if (!defined('MTG_ADD_EDITION_PAGE')) {
	define('MTG_ADD_EDITION_PAGE', "mtg-add-templates");
}
if (!defined('MTG_TABLE_EDITIONS')) {
	define('MTG_TABLE_EDITIONS', "mmkt_editions");
}
if (!defined('MTG_TABLE_POSTS')) {
  define('MTG_TABLE_POSTS', "mmkt_posts");
}
if (!defined('MTG_PERMISSION')) {
  define('MTG_PERMISSION', "activate_plugins");
}


// Loading i18n files
load_plugin_textdomain( MTG_TEXTDOMAIN, false, "/mmkt_template_generator/languages" );

// Include getters functions
include(MTG_PLUGIN_DIR . '/includes/mtg_getters.php');

// Include action functions
include(MTG_PLUGIN_DIR . '/includes/mtg_actions.php');

// Installing and Unistalling Functions
include(MTG_PLUGIN_DIR . '/includes/mtg_install.php');

// Adding a menu item
include(MTG_PLUGIN_DIR . '/includes/mtg_menus.php');


?>