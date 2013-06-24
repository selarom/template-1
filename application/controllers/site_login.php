<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 

class Site_login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('products_model', 'Product');
        $data['site_name'] = $this->config->item('site_name');
        $data['company_name'] = $this->config->item('company_name');
        $this->load->vars( $data );
		$this->is_logged_in();
	}

	function members_area()
	{
		$data['page_title'] = 'Intranet';
		$this->load->view('portal/members/header', $data);
		$this->load->view('portal/members/index');
		$this->load->view('portal/members/footer', $data);
	}

	// function product_list()
	// {
	// 	$data['page_title'] = 'Product Listings';
	// 	$data['products'] = $this->Product->get_all('products');
	// 	$data['category'] = $this->Product->level_tree('home','2');
	// 	$this->load->view('portal/members/header', $data);
	// 	$this->load->view('portal/members/product-list');
	// 	$this->load->view('portal/members/footer', $data);
	// }

	// function category_list()
	// {
	// 	$data['page_title'] = 'Category Listings';
	// 	$data['category'] = $this->Product->level_tree('home', '2');
	// 	$this->load->view('portal/members/header', $data);
	// 	$this->load->view('portal/members/category-list', $data);
	// 	$this->load->view('portal/members/footer', $data);
	// }

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		// $membership = $this->session->userdata();
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('message', 'You do not have permission to access this page. Please login to access all resources.');
			//print_r($this->session->all_userdata());
			redirect('login');

		}
	}

	function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_logged_in');
		$this->session->set_flashdata('message', 'You have been successfully logged out.');
		redirect('login');
	}

	function settings() {
		$data['page_title'] = 'Settings';
		$this->load->view('portal/members/header', $data);
		$this->load->view('portal/members/settings');
		$this->load->view('portal/members/footer', $data);
	}

	function users() {
		$this->load->view('portal/members/users');
	}
}