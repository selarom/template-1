<div id="product-listing">
	<h1><?php echo $page_title;?></h1>
	<div id="right"><a class="add button blue" href="#">Add Product<span></span></a></div>
	<ul>
	<?php 
		$this->load->view('wysiwyg');
		foreach($products as $item) {
		echo '<li class="item">';
		echo '<div class="left">' . $item->name . '</div>';

		echo '<div class="right">' . form_hidden('id', $item->product_id) . '<span><a class="edit" href="#">Edit</a> | <a class="delete" href="#">Delete</a></span></div>';
		echo '<div class="clear"></div></li>';
	}?>
	</ul>
</div>

<script>
	var category = <?php echo json_encode($category); ?>;
	var products = <?php echo json_encode($products); ?>;
	console.log(products);
</script>
