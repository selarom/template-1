<?php

class login extends CI_Controller {

	function login() {
		parent::__construct();
		$this->load->model('users_model', 'Users');
        $data['site_name'] = $this->config->item('site_name');
        $data['company_name'] = $this->config->item('company_name');
        $this->load->vars( $data );
	}

	function index () {
		$data['page_title'] = 'Login';
		$this->load->view('portal/header', $data);
		$this->load->view('login_form', $data);
		$this->load->view('portal/footer', $data);
	}

	function validate_credentials() {
		$this->validation();
		$validate_username = $this->Users->validate();
		$active = $this->Users->status();

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else 
		{
			if($validate_username) //if the user's credentials validated....
			{
				if($active) {
					$data = array(
					'username' => $this->input->post('username'),
					'is_logged_in' => true
					);
					$this->session->set_userdata($data);
					redirect('member-area');
				}
				else {
					$this->session->set_flashdata('message', 'Accont is not active.');
					redirect('login');
				}
			}
			else
			{
				$this->session->set_flashdata('message', 'Username or password incorrect.');
				redirect('login');
			}
		}
	}

	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
	}

	function validation() {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//field name, error message, validation rules

		$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
	}

	function create_member()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//field name, error message, validation rules

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');

		if($this->form_validation->run() == FALSE)
		{
			$this->signup();
		}
		else
		{
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
		    else
		    {
		    	$this->load->view('signup_form');
		    }
		}

	}
}