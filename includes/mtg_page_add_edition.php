<?php
/*
	TODO Essa página faz duas coisas, isso está errado! Separe o editar do criar!
*/
?>
<div class="wrap">
	<h2><?php _e("Add New Edition", MTG_TEXTDOMAIN)?></h2>
	
	<?php 
		$edit = FALSE;
		if(isset($_GET["edit"])) : 
			$edit = TRUE;
			$edition_id = intval($_GET["edit"]);
			
			if(count($_POST) > 0) :
				$message = mtg_validate_and_edit_edition($_POST);
			?>
			<div id="message" class="updated">
				<p><strong><?php echo $message?></strong></p>
			</div>
			<?php
			endif;
			$edition = mtg_get_edition($edition_id);
		elseif(count($_POST) > 0) :
			$message = mtg_validate_and_add_new_edition($_POST);
			?>
			<div id="message" class="updated">
				<p><strong><?php echo $message?></strong></p>
			</div>
	<?php endif; ?>
	
	<?php $action = (isset($edition)) ? "&edit=$edition_id" : "";?>
	
	<form action="<?php echo get_admin_url() . "admin.php?page=" . MTG_ADD_EDITION_PAGE . $action?>" method="post" accept-charset="utf-8">
		<table class="form-table">
			<tr valign="top">
				<th><label for="edition_number"><?php _e("Edition Number", MTG_TEXTDOMAIN);?></label></th>
				<td>
					<input type="text" name="edition_number" onkeyup="javascript:mask(this,numberMask);" maxlength="5" id="edition_number" value="<?php echo (isset($edition)) ? $edition->edition_number : (isset($_POST["edition_number"]) ? $_POST["edition_number"] : ""); ?>" />
				</td>
			</tr>
			<tr>
				<th><label for="edition_date"><?php _e("Edition date", MTG_TEXTDOMAIN);?></label></th>
				<td>
					<input type="text" name="edition_date"  id="edition_date" onkeydown="javascript:mask(this,dateMask);" maxlength="10" value="<?php echo (isset($edition)) ? date("d/m/Y", strtotime($edition->edition_date)) : (isset($_POST["edition_date"]) ? $_POST["edition_date"] : ""); ?>" />
				</td>
		</table>
		<input type="hidden" name="created_by" value="<?php echo (isset($edition)) ? $edition->create_by : $current_user->ID;?>" id="created_by" />
		<?php if(isset($edition)) : ?>
			<input type="hidden" name="id" value="<?php echo $edition->id?>" id="id" />
		<?php endif; ?>
		<p class="submit"><input type="submit" value="<?php _e("Save Options", MTG_TEXTDOMAIN);?>" id="submit" class="button-primary" /></p>
	</form>
</div>