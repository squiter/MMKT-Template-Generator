<?php
// Call function to create a menu item
add_action('admin_menu', 'mtg_config_menu');

// function to config the menu item
function mtg_config_menu(){
	$config       = add_menu_page( "MMKT Template Generator", 
									__("MMKT Settings", MTG_TEXTDOMAIN), 
									MTG_PERMISSION, MTG_CONFIG_PAGE, 
									"mtg_render_config");
	$editions    = add_submenu_page(MTG_CONFIG_PAGE, 
									__("All Editions", MTG_CONFIG_PAGE), 
									__("All Editions", MTG_CONFIG_PAGE), 
									MTG_PERMISSION, 
									MTG_EDITIONS_PAGE, 
									"mtg_render_editions" );
	$add_edtion = add_submenu_page(MTG_CONFIG_PAGE, 
									__("Add Edition", MTG_CONFIG_PAGE), 
									__("Add New Edition", MTG_CONFIG_PAGE), 
									MTG_PERMISSION, 
									MTG_ADD_EDITION_PAGE, 
									"mtg_render_add_edition" );
	
	add_action( "admin_print_styles-" . $add_edtion, 'mtg_add_js');
	add_action( "admin_print_styles-" . $editions, 'mtg_add_js');
}

function mtg_add_js(){
	$version = "1.7.1";
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js', false, $version);
	
    wp_enqueue_script('mtg-js', MTG_PLUGIN_ASSETS_URL . '/js/mtg.js', array("jquery"));
}

// Function to require config page	
function mtg_render_config(){
	$args = array(
		'type'                     => 'post',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'hierarchical'             => 0,
		'taxonomy'                 => 'category',
		'pad_counts'               => false 
	);
	$categories = get_categories($args);
	
	$default_category = get_option("mmkt_default_category");
	
	require("mtg_page_config.php");
}

// Function to require templates page	
function mtg_render_editions(){	
	require("mtg_page_editions.php");
}

function mtg_render_add_edition(){
	global $current_user;
	get_currentuserinfo();
	require("mtg_page_add_edition.php");
}
?>