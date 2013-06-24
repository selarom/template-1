<div id="cart" class="container">
	<div class="box">
		<h1 class="section">Your Shopping Cart</h1>
		<?php echo form_open('cart/update'); ?>

		<!-- anchor('products', 'Continue Shopping'); ?> -->
		<div>
		<table class="cart-table" cellpadding="0" cellspacing="0">

		<tr>
		  <th class="product-heading">Product</th>
		  <th class="quantity-pricing">Quantity</th>
		  <th class="price-heading">Price</th>
		  <th class="price-heading">Total Price</th>
		</tr>

		<?php $i = 1; ?>

		<?php foreach ($this->cart->contents() as $product): ?>

			<?php echo form_hidden('rowid[]', $product['rowid']); ?>

			<tr>
			   <td class="product">
			   		<?php echo '<img src="' . base_url() . 'images/dspskin/products/'. $product['image_name'] . '" width="60px" height="60px" />';?> 
			  		<?php echo $product['name']; ?>

					<?php if ($this->cart->has_options($product['rowid']) == TRUE): ?>
						
						<p>
							<?php foreach ($this->cart->product_options($product['rowid']) as $option_name => $option_value): ?>

								<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

							<?php endforeach; ?>
						</p>

					<?php endif; ?>

			  </td>	
			  <td class="quantity"><?php echo form_input(array('id' => 'qty', 'name' => 'qty[]', 'value' => $product['qty'], 'maxlength' => '3', 'size' => '5')); ?> <?php $id=$product['rowid'].'_remove'; ?><button name="remove" type="submit" value="<?php echo htmlspecialchars($id); ?>">Remove</button></td>
			 
			  <td class="price"><?php echo $this->cart->format_number($product['price']); ?></td>
			  <td class="price">$<?php echo $this->cart->format_number($product['subtotal']); ?></td>
			</tr>

		<?php $i++; ?>

		<?php endforeach; ?>

		<tr class="update-info-cart">
		  <td colspan="4">
		  	<p>
		  		<span>Make any changes to your cart?</span>
		  		<?php echo form_submit('', 'Update your Cart'); ?>
				<?php echo anchor( '/cart/empty_cart', 'Empty Cart' ); ?>
		  	</p>
		  </td>
		</tr>

		</table>

		<?php echo '<p class="shopping">' . anchor( '/', 'Continue Shopping' ) . '</p>' ?>
		
		<div class="cart-summary-opt">
			<div class="cart-summary">
				<h3>Order Summary</h3>
				<span class="label">Subtotal:</span>
				<span class="value"></span>
				<span class="label"></span>
				<span class="value"></span>
				<span class="total label">Total:</span>
				<span class="total value">$<?php echo $this->cart->format_number($this->cart->total()); ?></span>
				<?php echo anchor('https://www.dspskincareproducts.com/checkout', 'Checkout', 'class="btn btn-primary"'); ?>
			</div>	
		
		</div>
		<div class="clear"></div>
		<span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=uMMnaAZQ8vtlb52oAdmtNeLNcdIjKfmjZNoGMErYyl1ZIF5BekIs2k"></script></span>
		<script type="text/javascript">
(function(){
    $("#qty").keyup(function(){
        alert(this.val());
    })();

})
</script>
	</div>
</div>

