<div id="order-confirmation" class="container">
	<div class="box">
		<h1 class="section">Checkout:</h1>
		<div class="header-main">
			<div class="checkout-progress">
				<ul>
					<li>
						<span class="step">1</span>
						<h3>Billing</h3>
						<span class="arrow"></span>
					</li>
					<li class="active">
						<span class="step">2</span>
						<h3>Confirmation</h3>
						<span class="arrow"></span>
					</li>
					<li>
						<span class="step">3</span>
						<h3>Payment</h3>
						<span></span>
					</li>
				</ul>
			</div>
		</div>
		<div class="checkout-hr container"></div>
		<h2 class="confirm-title">Order Confirmation</h2>
		<div class="checkout-box">
			<div class="checkout-title-wrap">
				<h3>Billing Information</h3>
			</div>
			<div id="confirmation">
				<?php echo form_open('checkout/purchase');?>
				<ul>
					<li><?php echo '<span class="label">First Name: ' . form_input('first_name', set_value('frist_name', $data['first_name'] )) . '</span>'; ?></li>
					<li><?php echo '<span class="label">Last Name: ' . form_input('last_name', set_value('last_name', $data['last_name'] )) . '</span>'; ?></li>
					<li><?php echo '<span class="label">Address: ' . form_input('address', set_value('address', $data['address'] )) . '</span>'; ?></li>
					<li><?php echo '<span class="label">City: ' . form_input('city', set_value('city', $data['city'] )) . '</span>'; ?></li>
					<li><?php echo '<span class="label">State: ' . form_input('state', set_value('state', $data['state'] )) . '</span>'; ?></li>
					<li><?php echo '<span class="label">Zip: ' . form_input('zip', set_value('zip', $data['zip'] )) . '</span>'; ?></li>
						<?php if(in_array("CA", $data)) {
						$tax_percent = $data['tax'];
						$tax = $this->cart->format_number($this->cart->total()*$tax_percent);
						echo form_hidden('tax', $tax); }?>
				</ul>					
			</div>
			<input type="submit" class="paypal" value="Pay With PayPal" />
		</div>
		<div class="item-summary-box">
			<div class="summary-title-wrap">
				<h3>Order Summary</h3>
			</div>
			
			<p>Total Items: <?php echo $this->cart->total_items();?></p>

			<table class="summary-table" cellpadding="0" cellspacing="0">
			<?php foreach ($this->cart->contents() as $product): ?>
				<tr>
					<td>
						<?php echo '<img src="https://www.dspskincareproducts.com/images/dspskin/products/'. $product['image_name'] . '" width="45px" height="45px" />';?> 
					</td>
					<td class="product">
						<?php echo '<p>' . $product['name'] . '</p>';?>
						<?php echo 'Quantity: ' . $product['qty']; ?>
						<?php echo 'Price: ' . $this->cart->format_number($product['price']); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				<tr>
					<td class="price"><?php   
						$tax = 0;
						if(in_array("CA", $data))
							{
								$tax_percent = $data['tax'];
								$tax = $this->cart->format_number($this->cart->total()*$tax_percent);
								echo 'Tax: ' . $tax . '<br>';
							} 
							echo 'Total: $' . $this->cart->format_number($this->cart->total()+$tax);?>
					</td>
				</tr>
		</table>
		</div>
		<div class="clear"></div>
	<span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=uMMnaAZQ8vtlb52oAdmtNeLNcdIjKfmjZNoGMErYyl1ZIF5BekIs2k"></script></span>
		
	</div>
</div>						