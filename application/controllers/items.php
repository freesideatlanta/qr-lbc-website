<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Items extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('items_model');
		//$this->layout->placeholder("title","Lifecycle Building Center");
	}
	
	public function view($page = "home") {
		if ( ! file_exists('application/views/pages/'.$page.'.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['items'] = $this->items_model->getAllItems();
		
		$this->load->view('templates/header', $data);
		$this->load->view('items/index', $data);
		$this->load->view('templates/footer', $data);		
	}
	
	public function index() {
		$this->load->view('templates/header');
		$this->load->view('templates/footer');
	}
}
