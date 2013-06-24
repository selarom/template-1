<!-- the form used to add and update user records -->
<?php $this->load->view('forms/add_update');?>

<!-- the form used to delete user records -->
<?php $this->load->view('forms/delete');?>

<!-- the table holding our user records -->
<table border="0" cellpadding="0" cellspacing="0" id="ajax_table" class="table table-bordered table-striped">

	<div class="span5 offset1"><h1>Blog Management</h1></div>
	
	<thead>
		<tr>
			<th width="150">Created</th>
			<th width="450">Title</th>
			<th width="100">
				<button class="add float-right">Add Blog</button>
			</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<td colspan="7"><p class="text-info"><span><?=count($blog);?></span> blogs in the database</p></td>
		</tr>
	</tfoot>
	
	<tbody>
		
		<!-- load another view here! -->
		<?php $this->load->view('portal/members/blogs/listing_data.php'); ?>					

	</tbody>
	
</table>

