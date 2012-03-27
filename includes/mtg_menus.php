<?php
// Call function to create a menu item
add_action('admin_menu', 'mtg_config_menu');

// function to config the menu item
function mtg_config_menu(){
	add_menu_page( "MMKT Template Generator", __("MMKT Template", MTG_TEXTDOMAIN), "activate_plugins", MTG_CONFIG_PAGE, "mtg_render_config");
	add_submenu_page(MTG_CONFIG_PAGE, __("All Templates", MTG_CONFIG_PAGE), __("All Templates", MTG_CONFIG_PAGE), "activate_plugins", MTG_TEMPLATE_PAGE, "mtg_render_templates" );
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
function mtg_render_templates(){
	
	$templates = mtg_get_templates();
	
	require("mtg_page_templates.php");
}
?>