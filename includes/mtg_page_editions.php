<?php
if(isset($_GET["delete"])) :
	$edition_id = intval($_GET["delete"]);
	if(mtg_edition_exists($edition_id)) : 
		if(mtg_delete_edition($edition_id)) :
			$message = __("edition was deleted successfully.", MTG_TEXTDOMAIN);
		else :
			$message = __("Error: The edition was not deleted.", MTG_TEXTDOMAIN);
		endif;
	endif;
endif;

$editions = mtg_get_editions();
?>
<div class="wrap">
	<h2>
		<?php _e("All Editions", MTG_TEXTDOMAIN);?>
		<a href="<?php echo get_admin_url()?>admin.php?page=<?php echo MTG_ADD_EDITION_PAGE?>" class="add-new-h2"><?php _e("Add New", MTG_TEXTDOMAIN);?></a>
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
			<?php if(isset($editions) && count($editions) > 0) : ?>
				<?php foreach($editions as $i => $edition) : 
					$user = get_userdata($edition->created_by);
					$delete_link = get_admin_url() . "admin.php?page=" . MTG_EDITIONS_PAGE . "&delete=$edition->id";
					$edit_link = get_admin_url() . "admin.php?page=" . MTG_EDIT_EDITION_PAGE . "&edition_id=$edition->id";
					?>
					<tr <?php echo ($i%2 == 0) ? "class='alternate'" : '';?>>
						<td><?php echo $edition->edition_number; ?></td>
						<td><?php echo date("d / m / Y", strtotime($edition->edition_date)); ?></td>
						<td style="text-transform:capitalize"><?php echo (isset($user) && !empty($user)) ? $user->user_login : "" ?></td>
						<td><?php echo date("d / m / Y - H:i",strtotime($edition->created_at)); ?></td>
						<td>
							<a href="<?php echo $edit_link;?>"><?php _e("Edit", MTG_TEXTDOMAIN);?></a> &nbsp; | &nbsp; 
							<a href="javascript:void();" onclick="javascript:deleteedition(this);" title="<?php echo _e("This action will remove this edition permanently.\rDo you want  delete this?", MTG_TEXTDOMAIN);?>" rel="<?php echo $delete_link;?>"><?php _e("Delete", MTG_TEXTDOMAIN)?></a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
			<tr class="no-items">
				<td class="colspanchange" colspan="4">
					<?php _e("No editions found", MTG_TEXTDOMAIN);?>
				</td>
			</tr>	
			<?php endif; ?>
		</tbody>
</div>