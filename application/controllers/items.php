<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Items extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('items_model');
	}
	
	public function view($page = "home") {
		if ( ! file_exists('application/views/pages/'.$page.'.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		// Run some setup
		$this->rest->initialize(array('server' => 'http://localhost:3000'));
		
		$data['title'] = ucfirst($page); // Capitalize the first letter
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		//print_r($items);
		var_dump($this->items_model->getAllItems());
		$this->load->view('templates/footer', $data);		
	}
	
	public function index() {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer', $data);
	}
}
