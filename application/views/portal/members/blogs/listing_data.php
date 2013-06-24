	<?php $count = 0; 
	foreach($blog as $item): 
	$this->load->helper('date');
	$datestring = "%l, %F %d, %Y - %h:%i %A";?>
	<tr id="row_<?=$item->blog_id;?>" <?=($count % 2 ? 'class="alternate"' : '');?>>
		<td><?=mdate($datestring,mysql_to_unix($item->post_date));?></td>
		<td><span><?=$item->name;?></span><input type="hidden" value="<?= htmlentities($item->content);?>"></td>
		<td>
			<ul class="buttons">
				<li><button class="edit" id="update_<?=$item->blog_id;?>">Update</button></li>
				<li><button class="remove" id="remove_<?=$item->blog_id;?>">Remove</button></li>
			</ul>
		</td>
	</tr>

	<?php $count++; ?>
	<?php endforeach; ?>