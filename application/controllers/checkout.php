<?php

class Checkout extends CI_Controller {

	function Checkout() {
		parent::__construct();
        $data['site_name'] = $this->config->item('site_name');
        $data['company_name'] = $this->config->item('company_name'); 
        $this->load->vars( $data );
	}

	function index () {
		if($this->cart->total_items() > 0) {
			$data['page_title'] = 'Billing';
			$data['main_content_checkout'] = 'checkout_step_1';
			$this->load->view('https-header', $data);
			$this->load->view('includes/checkout_template', $data);
			$this->load->view('footer');
		} else {
			redirect('cart');
		}
	}

	function confirm_checkout_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//field name, error message, validation rules

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[80]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('zip', 'Zip','trim|required');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			
			$data['main_content_checkout'] = 'signup_successful';
			$info = array(
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email_address' => $this->input->post('email_address'),
							'address' => $this->input->post('address'),
							'state' => $this->input->post('state'), 
							'city' => $this->input->post('city'),
							'zip' => $this->input->post('zip'),
						);
			if($this->input->post('state') == 'CA') {
				$info['tax'] = '.09';
			}

			$data['data'] = $info;
			$data['page_title'] = 'Confirmation';
			$this->load->view('https-header', $data);
			$this->load->view('confirm_order', $data);
			$this->load->view('footer');
		}

	}

	function create_checkout_user()
	{
		
			$this->load->model('checkout_model', 'Checkout');
			if($query = $this->Checkout->insert_guest()) {
				redirect('products/purchase');
			}
		
	}

	function purchase() 
	{
		$products = $this->cart->contents();

		$this->load->library( 'Paypal_Lib' ); 
		$this->paypal_lib->add_field( 'business', $this->config->item( 'paypal_email' ));
		$this->paypal_lib->add_field( 'email', $this->config->item('paypal_email')); 
		$this->paypal_lib->add_field( 'return', site_url( 'paypal/success' ) ); 
		$this->paypal_lib->add_field( 'cancel_return', site_url( 'paypal/cancel' ) ); 
		$this->paypal_lib->add_field( 'notify_url', site_url( 'paypal/ipn' ) ); // <-- IPN url 
		$i=1;    
		foreach($products as $item) {
			//echo $item['name'];
			$this->paypal_lib->add_field( 'item_name_' .$i, $item['name'] ); 
			$this->paypal_lib->add_field( 'item_number_' .$i, $i);
			$this->paypal_lib->add_field( 'quantity_' .$i, $item['qty']);
			$this->paypal_lib->add_field( 'amount_' .$i, $item['price'] );
			$i++;
		 }
		 if($this->input->post('tax')){
		 	$this->paypal_lib->add_field( 'tax_cart', $this->input->post('tax'));
		 }  
		//$this->paypal_lib->dump();
		redirect( $this->paypal_lib->paypal_get_request_link() );
	}
}