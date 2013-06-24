<div id="billing-info" class="container">
	<div class="box">
		<h1 class="section">Checkout:</h1>
		<div class="header-main">
			<div class="checkout-progress">
				<ul>
					<li class="active">
						<span class="step">1</span>
						<h3>Billing</h3>
						<span class="arrow"></span>
					</li>
					<li>
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
		<?php echo form_open('https://www.dspskincareproducts.com/checkout/confirm_checkout_user'); ?>
		<div class="checkout-box">
			<div class="checkout-title-wrap">
				<h3>Billing Information</h3>
			</div>
			<div class="first-name-wrap">
				<?php echo '<span class="label">' . 'First Name:' . form_input('first_name') . '</span>'; ?>
				<?php echo form_error('first_name'); ?>
			</div>

			<div class="last-name-wrap">
				<?php echo '<span class="label">' . 'Last Name:' . form_input('last_name') . '</span>'; ?>	
				<?php echo form_error('last_name'); ?>
			</div>

			<div class="full">
				<?php echo '<span class="label">' . 'Company:' . form_input('company') . '</span>'; ?>
				<?php echo form_error('company'); ?>
			</div>

			<div class="full">
				<?php echo '<span class="label">' . 'Address:' . form_input('address') . '</span>'; ?>
				<?php echo form_error('address'); ?>
			</div>

			<div class="half left">
				<?php echo '<span class="label">' . 'City:' . form_input('city') . '</span>'; ?>
				<?php echo form_error('city'); ?>
			</div>

			<div class="half right">
				<?php $states = array(	'AL' => 'Alabama', 
										'AK' => 'Alaska', 
										'AZ' => 'Arizona', 
										'AR' => 'Arkansas', 
										'CA' => 'California',
										'CO' => 'Colorado',
										'CT' => 'Connecticut',
										'DE' => 'Delaware',
										'FL' => 'Florida',
										'GA' => 'Georgia',
										'HI' => 'Hawaii',
										'ID' => 'Idaho',
										'IL' => 'Illinois',
										'IN' => 'Indiana',
										'IA' => 'Iowa',
										'KS' => 'Kansas',
										'KY' => 'Kentucky',
										'LA' => 'Louisiana',
										'ME' => 'Maine',
										'MD' => 'Maryland',
										'MA' => 'Massachusetts',
										'MI' => 'Michigan',
										'MN' => 'Minnesota',
										'MS' => 'Mississippi',
										'MO' => 'Missouri',
										'MT' => 'Montana',
										'NE' => 'Nebraska',
										'NV' => 'Nevada',
										'NH' => 'New Hampshire',
										'NJ' => 'New Jersey',
										'NM' => 'New Mexico',
										'NY' => 'New York',
										'NC' => 'North Carolina',
										'ND' => 'North Dakota',
										'OH' => 'Ohio',
										'OK' => 'Oklahoma',
										'OR' => 'Oregon',
										'PA' => 'Pennsylvania',
										'RI' => 'Rhode Island',
										'SC' => 'South Carolina',
										'SD' => 'South Dakota',
										'TN' => 'Tennessee',
										'TX' => 'Texas',
										'UT' => 'Utah',
										'VT' => 'Vermont',
										'VA' => 'Virginia',
										'WA' => 'Washington',
										'WV' => 'West Virginia',
										'WI' => 'Wisconsin',
										'WY' => 'Wyoming'
										); ?>
				<?php echo '<span class="label">' . 'State:' . form_dropdown('state', $states, 'CA') . '</span>'; ?>
				<?php echo form_error('state'); ?>
			</div>

			<div class="half left">
				<?php echo '<span class="label">' . 'Zip Code:' . form_input('zip') . '</span>'; ?>
				<?php echo form_error('zip'); ?>
			</div>
			
			<div class="half left">
				<?php echo '<span class="label">' . 'Email Address:' . form_input('email') . '</span>'; ?>
				<?php echo form_error('email'); ?>
			</div>

			<div class="quarter left">
				<?php echo form_submit('submit', 'Next'); ?>
			</div>
		</div> 
		<div class="clear"></div>
	<span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=uMMnaAZQ8vtlb52oAdmtNeLNcdIjKfmjZNoGMErYyl1ZIF5BekIs2k"></script></span>
		
	</div>
</div>





