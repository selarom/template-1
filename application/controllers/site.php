<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Site extends CI_Controller {

	 function Site() { 
        parent::__construct();
        $this->load->model('products_model', 'Products');
        $data['site_name'] = $this->config->item('site_name');
        $data['company_name'] = $this->config->item('company_name'); 
        $this->load->vars($data); 
        //$this->output->nocache();
    } 

	function index() {
		$maintenance = FALSE;
		$ip = $this->input->ip_address();
		$valid_ips = array('173.200.78.202','107.210.29.100','96.25.195.12');

		if($maintenance) {
			if(in_array($ip, $valid_ips)) {
        	$data['page_title'] = 'HOME';
			$this->load->view('header', $data);
			//$this->load->view('navigation');
			$this->load->view('home');
			$this->load->view('footer');
			} else {
				echo '<div id="down"><p>We are currently under maintenance.</p><p>Please check back tomorrow.</p><br><br>If you need immediate assistance, please contact us at yew@dspskincareproducts.com or call us at (213)389-2366.</div>';
			}
		} else {
			$data['page_title'] = 'HOME';
			$this->load->view('header', $data);
			//$this->load->view('navigation');
			$this->load->view('home');
			$this->load->view('footer');
		}
	}

	function down() {
		echo 'Our website is currently down, please check back in an hour.';
	}

	function css() {
		$this->load->view('css.php');
	}

	function floats() {
		$this->load->view('floats.php');
	}

	function position() {
		$this->load->view('position.php');
	}

	function terms () {
		$data['page_title'] = 'Terms and Conditions';
		$this->load->view('header', $data);
		$this->load->view('terms');
		$this->load->view('footer', $data);
	}

	function privacy_policy() {
		$data['page_title'] = 'Privacy Policy';
		$this->load->view('header', $data);
		$this->load->view('privacy-policy');
		$this->load->view('footer', $data);
	}

	function contact() {
		$data['page_title'] = 'Contact Us - Request a quote';
		$this->load->view('header', $data);
		$this->load->view('contact');
		$this->load->view('footer', $data);
	}

	function contact_form_success() {
		$data['page_title'] = 'Submit Successful';
		$this->load->view('header', $data);
		$this->load->view('contact_form_success', $data);
		$this->load->view('footer', $data);
	}
}	