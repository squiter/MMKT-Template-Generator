<?php
function mtg_install(){
	global $wpdb;
	
	$table_name1 = $wpdb->prefix . MTG_TABLE_EDITIONS;
	$table_name2 = $wpdb->prefix . MTG_TABLE_POSTS;
	
	$sql = "CREATE TABLE $table_name1 (
				id int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
				edition_number int(5) UNSIGNED NOT NULL,
				edition_date date DEFAULT '0000-00-00' NOT NULL,
				template_folder varchar(50) NOT NULL,
				created_by bigint(20) UNSIGNED NOT NULL,
				created_at datetime DEFAULT '000-00-00 00:00:00' NOT NULL,
				PRIMARY KEY(id)
			);
			
			CREATE TABLE $table_name2 (
				id int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
				mkt_template_id int(5) UNSIGNED NOT NULL,
				post_id bigint(20) UNSIGNED NOT NULL,
				featured_post boolean DEFAULT FALSE,
				PRIMARY KEY(id),
				INDEX (mkt_template_id)
			);";				
		
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option("mmkt_default_category", "");
}

function mtg_uninstall(){
	global $wpdb;
	
	$table_name1 = $wpdb->prefix . "mmkt_templates";
	$table_name2 = $wpdb->prefix . "mmkt_posts";
	
	$sql = "DROP DATABASE $table_name1;
			DROP DATABASE $table_name2;";
						
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	delete_option("mmkt_default_category");
}

register_activation_hook( __FILE__, 'mtg_install' );
register_uninstall_hook( __FILE__, 'mtg_uninstall' );
?>