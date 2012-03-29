<?php
if(isset($_GET["delete"])) :
	$template_id = intval($_GET["delete"]);
	if(mtg_template_exists($template_id)) : 
		if(mtg_delete_template($template_id)) :
			$message = __("Template was deleted successfully.", MTG_TEXTDOMAIN);
		else :
			$message = __("Error: The template was not deleted.", MTG_TEXTDOMAIN);
		endif;
	endif;
endif;

$templates = mtg_get_templates();
?>
<div class="wrap">
	<h2>
		<?php _e("All Templates", MTG_TEXTDOMAIN);?>
		<a href="<?php echo get_admin_url()?>admin.php?page=<?php echo MTG_ADD_TEMPLATE_PAGE?>" class="add-new-h2"><?php _e("Add New", MTG_TEXTDOMAIN);?></a>
	</h2>
	<?php if(isset($message)) : ?>
		<div id="message" class="updated">
			<p><strong><?php echo $message?></strong></p>
		</div>
	<?php endif; ?>
	<table class="wp-list-table widefat fixed pages" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" class="manage-column" width="25%">
					<?php _e("Edition number", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="25%">
					<?php _e("Release date", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="25%">
					<?php _e("Created by", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="15%">
					<?php _e("Created date", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="10%"></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col" class="manage-column">
					<?php _e("Edition number", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column">
					<?php _e("Release date", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column">
					<?php _e("Created by", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column">
					<?php _e("Created date", MTG_TEXTDOMAIN);?>
				</th>
				<th></th>
			</tr>
		</tfoot>
		<tbody id="the-list">
			<?php if(isset($templates) && count($templates) > 0) : ?>
				<?php foreach($templates as $i => $template) : 
					$user = get_userdata($template->created_by);
					$delete_link = get_admin_url() . "admin.php?page=" . MTG_TEMPLATE_PAGE . "&delete=$template->id";
					$edit_link = get_admin_url() . "admin.php?page=" . MTG_TEMPLATE_PAGE . "&edit=$template->id";
					?>
					<tr <?php echo ($i%2 == 0) ? "class='alternate'" : '';?>>
						<td><?php echo $template->edition_number; ?></td>
						<td><?php echo date("d / m / Y", strtotime($template->edition_date)); ?></td>
						<td style="text-transform:capitalize"><?php echo (isset($user) && !empty($user)) ? $user->user_login : "" ?></td>
						<td><?php echo date("d / m / Y - H:i",strtotime($template->created_at)); ?></td>
						<td>
							<a href="<?php echo $edit_link;?>"><?php _e("Edit", MTG_TEXTDOMAIN);?></a> &nbsp; | &nbsp; 
							<a href="javascript:void();" onclick="javascript:deleteTemplate(this);" title="<?php echo _e("This action will remove this template permanently.\rDo you want  delete this?", MTG_TEXTDOMAIN);?>" rel="<?php echo $delete_link;?>"><?php _e("Delete", MTG_TEXTDOMAIN)?></a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
			<tr class="no-items">
				<td class="colspanchange" colspan="4">
					<?php _e("No templates found", MTG_TEXTDOMAIN);?>
				</td>
			</tr>	
			<?php endif; ?>
		</tbody>
</div>