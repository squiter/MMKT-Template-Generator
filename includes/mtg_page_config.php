<div class="wrap">
	<h2><?php _e("MMKT Template Generator Config", MTG_TEXTDOMAIN)?></h2>
	
	<?php if(isset($_POST["default_category"]) && !empty($_POST["default_category"])) : 
		update_option("mmkt_default_category", $_POST["default_category"]); ?>
		<div id="message" class="updated">
			<p><strong><?php _e("Your settings was saved successfully", MTG_TEXTDOMAIN);?></strong></p>
		</div>
	<?php endif;?>
	
	<form action="<?php $_SERVER["PHP_SELF"]?>" method="post" accept-charset="utf-8">
		<table class="form-table">
			<tr valign="top">
				<th><label for="default_category"><?php _e("Default category", MTG_TEXTDOMAIN);?></label></th>
				<td>
					<select name="default_category" id="default_category">
						<option value=""><?php _e("Any", MTG_TEXTDOMAIN);?></option>
						<?php if(isset($categories) && count($categories) > 0) : ?>
							<?php foreach($categories as $cat) : ?>
								<option value="<?php echo $cat->cat_ID?>" <?php echo ($cat->cat_ID == get_option("mmkt_default_category")) ? " selected='selected' " : "";?>><?php echo $cat->name?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</td>
			</tr>
		</table>

		<p class="submit"><input type="submit" value="<?php _e("Save Options", MTG_TEXTDOMAIN);?>" id="submit" class="button-primary" /></p>
	</form>
</div>