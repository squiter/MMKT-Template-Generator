<?php
function mtg_get_editions(){
	global $wpdb;
	$table_name = $wpdb->prefix . MTG_TABLE_EDITIONS;

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

function mtg_get_edition($edition_id){
	global $wpdb;
	$table_name = $wpdb->prefix . MTG_TABLE_EDITIONS;

	$sql = "SELECT 
				id,
				template_folder,
				edition_number,
				edition_date,
				created_by,
				created_at
			FROM {$table_name}
			WHERE id = $edition_id
			LIMIT 1";

	$edition =  $wpdb->get_results($sql);
	return (isset($edition[0])) ? $edition[0] : NULL;
}
?>