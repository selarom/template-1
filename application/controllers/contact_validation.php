<?php

class Contact_validation extends CI_Controller {

	function Contact_validation() {
		parent::__construct();
        $data['site_name'] = $this->config->item('site_name');
        $data['company_name'] = $this->config->item('company_name');
        $this->load->vars( $data );
	}

	function index () {
			$data['page_title'] = 'Contact Form';
			$this->load->view('header', $data);
			$this->load->view('contact', $data);
			$this->load->view('footer', $data);
	}

	function validate_form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//field name, error message, validation rules

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('company', 'Company', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('inquiry', 'Inquiry', 'trim|required|max_length[50]');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$email = $this->input->post('email');
			$info = array(
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'company' => $this->input->post('company'),
							'email' => $email,
							'subject' => $this->input->post('subject'), 
							'inquiry' => $this->input->post('inquiry'),
						);
			$data['data'] = $info;
			$this->load->model('contact_model', 'Contact');
			if($query = $this->Contact->create_contact($info)) {
				$to      = $email . ', yew@dspskincareproducts.com'; // Send email to our user
				$subject = 'Confirmation of Inquery'; // Give the email a subject 
				$message = '

This is a confirmation email of the inquery you submited to DSP Skin Care Products.  One of our customer service representative will be contacting you.

Thank you for visiting our website.  You may follow us on twitter or facebook to recieve our current promotions and discounts.'; // Our message above including the link
					
				$headers = 'From:yew@dspskincareproduct.com' . "\r\n"; // Set fr
				mail($to, $subject, $message, $headers); // Send our email
				redirect('contact_form_success');
			}
		}

	}

}