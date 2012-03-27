<?php
function mtg_get_templates(){
	global $wpdb;
	$table_name = $wpdb->prefix . MTG_TABLE_TEMPLATES;

	$sql = "SELECT 
				id,
				template_folder,
				edition_number,
				edition_date,
				created_by,
				created_at
			FROM {$table_name}
			ORDER BY edition_number DESC";

	return $wpdb->get_results($sql);
}
?>