<div class="wrap">
	<h2>
		<?php _e("All Templates", MTG_TEXTDOMAIN);?>
		<a href="#" class="add-new-h2"><?php _e("Add New", MTG_TEXTDOMAIN);?></a>
	</h2>
	<table class="wp-list-table widefat fixed pages" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" class="manage-column" width="5%">
					<?php _e("ID", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="45%">
					<?php _e("Edition number", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="25%">
					<?php _e("Release date", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column" width="25%">
					<?php _e("Created date", MTG_TEXTDOMAIN);?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col" class="manage-column">
					<?php _e("ID", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column">
					<?php _e("Edition number", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column">
					<?php _e("Release date", MTG_TEXTDOMAIN);?>
				</th>
				<th scope="col" class="manage-column">
					<?php _e("Created date", MTG_TEXTDOMAIN);?>
				</th>
			</tr>
		</tfoot>
		<tbody id="the-list">
			<?php if(isset($templates) && count($templates) > 0) : ?>
				<?php foreach($templates as $template) : ?>
					<tr>
						<td><?php echo $template->id; ?></td>
						<td><?php echo $template->edition_number; ?></td>
						<td><?php echo $template->edition_date; ?></td>
						<td><?php echo $template->created_at; ?></td>
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