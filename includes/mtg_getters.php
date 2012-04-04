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

function mtg_get_template($template_id){
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
			WHERE id = $template_id
			LIMIT 1";

	$template =  $wpdb->get_results($sql);
	return (isset($template[0])) ? $template[0] : NULL;
}
?>