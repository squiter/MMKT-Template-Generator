<div class="wrap">
	<h2><?php _e("Add New Tamplate", MTG_TEXTDOMAIN)?></h2>
	
	<?php if(count($_POST) > 0) :
		$message = mtg_validate_and_add_new_template($_POST);
		?>
		<div id="message" class="updated">
			<p><strong><?php echo $message?></strong></p>
		</div>
	<?php endif;?>
	
	<form action="<?php $_SERVER["PHP_SELF"]?>" method="post" accept-charset="utf-8">
		<table class="form-table">
			<tr valign="top">
				<th><label for="edition_number"><?php _e("Edition Number", MTG_TEXTDOMAIN);?></label></th>
				<td>
					<input type="text" name="edition_number" onkeyup="javascript:mask(this,numberMask);" maxlength="5" id="edition_number" value="<?php echo (isset($_POST["edition_number"])) ? $_POST["edition_number"] : ""; ?>" />
				</td>
			</tr>
			<tr>
				<th><label for="edition_date"><?php _e("Edition date", MTG_TEXTDOMAIN);?></label></th>
				<td>
					<input type="text" name="edition_date"  id="edition_date" onkeydown="javascript:mask(this,dateMask);" maxlength="10" value="<?php echo (isset($_POST["edition_date"])) ? $_POST["edition_date"] : ""; ?>" />
				</td>
				
		</table>
		<input type="hidden" name="created_by" value="<?php echo $current_user->ID;?>" id="created_by" />
		<p class="submit"><input type="submit" value="<?php _e("Save Options", MTG_TEXTDOMAIN);?>" id="submit" class="button-primary" /></p>
	</form>
</div>