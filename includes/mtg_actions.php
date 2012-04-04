<?php

function mtg_validate_and_add_new_edition($data){
	$validation = mtg_validate_new_edition($data);
	if($validation["valid"]){
		if(mtg_add_edition($data)){
			return __("Your settings was saved successfully", MTG_TEXTDOMAIN);
		}else{
			return __("The edition was not saved in database, please try again.", MTG_TEXTDOMAIN);
		}
	}else{
		return $validation["message"];
	}
}

function mtg_validate_and_edit_edition($data){
	$validation = mtg_validate_new_edition($data);
	
	if($validation["valid"]){
		if(mtg_edit_edition($data)){
			return __("Your edition was edited successfully", MTG_TEXTDOMAIN);
		}else{
			return __("The edition was not edited, please try again.", MTG_TEXTDOMAIN);
		}
	}else{
		return $validation["message"];
	}
}

function mtg_validate_new_edition($data){
	$r["valid"] = FALSE;
	$r["message"] = "";
	
	$edition_number = (isset($data["edition_number"]) && !empty($data["edition_number"])) ? $data["edition_number"] : FALSE;
	$edition_date = (isset($data["edition_date"]) && !empty($data["edition_date"])) ? $data["edition_date"] : FALSE;
	
	if(isset($data) && !empty($data)){
		
		if($edition_number && ereg('[0-9]+',$edition_number)){
			$r["valid"] = TRUE;
		}else{
			$r["valid"] = FALSE;
			$r["message"] = __("Edition number", MTG_TEXTDOMAIN) . " " . __("is required", MTG_TEXTDOMAIN) . "<br />";
		}
		
		if($edition_date){
			if(ereg('[0-3][0-9]/[01][0-9]/[12][0-9]+', $edition_date) && strlen($edition_date) == 10){
				$r["valid"] = TRUE;
			}else{
				$r["message"] = $r["message"] . __("Edition date", MTG_TEXTDOMAIN) . " " . __("must be a valid date", MTG_TEXTDOMAIN) . "<br />";
				$r["valid"] = FALSE;
			}
		}else{
			$r["message"] = $r["message"] . __("Edition date", MTG_TEXTDOMAIN) . " " . __("is required", MTG_TEXTDOMAIN) . "<br />";
			$r["valid"] = FALSE;
		} 
		
	}else{
		$r["message"] = __("The edition was not created, please try again.", MTG_TEXTDOMAIN);
	}
	return $r;
}

function mtg_add_edition($data){
	global $wpdb;
	$default_template_folder = 'default';
	foreach ($data as $key => $value) ${$key} = $value;
	
	// create mysql format to edition_date
	$date_fragment = explode("/", $edition_date);
	$edition_date = $date_fragment[2] . "-" . $date_fragment[1] . "-" . $date_fragment[0];
	
	$template_folder = (isset($template_folder) && !empty($template_folder)) ? $template_folder : $default_template_folder;

	$tb = $wpdb->prefix . MTG_TABLE_EDITIONS;
	
	$sql = "INSERT INTO $tb (
				edition_number,
				edition_date,
				template_folder,
				created_by,
				created_at
			) VALUES (
				$edition_number,
				'$edition_date',
				'$template_folder',
				$created_by,
				NOW()
			);";
			
	/*
		TODO Validar esses campos com $wpdb->prepare o algo assim
	*/
	return $wpdb->query($sql);
}

function mtg_edit_edition($data){
	if(!isset($data["id"]) && empty($data["id"])) return FALSE;
	global $wpdb;
	foreach ($data as $key => $value) ${$key} = $value;
	$tb = $wpdb->prefix . MTG_TABLE_EDITIONS;

	// create mysql format to edition_date
	$date_fragment = explode("/", $edition_date);
	$edition_date = $date_fragment[2] . "-" . $date_fragment[1] . "-" . $date_fragment[0];
	
	$sql = "UPDATE $tb SET 
				edition_number = $edition_number,
				edition_date = '$edition_date'
			WHERE id = $id;";
			
	/*
		TODO Validar esses campos com $wpdb->prepare o algo assim
	*/
	return $wpdb->query($sql);
}

function mtg_edition_exists($edition_id){
	if(!isset($edition_id) || !is_int($edition_id)) return FALSE;
	
	global $wpdb;
	$tb = $tb = $wpdb->prefix . MTG_TABLE_EDITIONS;
	
	$sql = "SELECT COUNT(id) as qnt FROM $tb WHERE id = $edition_id;";
	$content = $wpdb->get_results($sql);
	return ($content[0]->qnt === "0") ? FALSE : TRUE;
}

function mtg_delete_edition($edition_id){
	if(!isset($edition_id) || !is_int($edition_id)) return FALSE;
	
	global $wpdb;
	$tb = $tb = $wpdb->prefix . MTG_TABLE_EDITIONS;
	
	$sql = "DELETE FROM $tb WHERE id = $edition_id;";
	return $wpdb->query($sql);
}
?>