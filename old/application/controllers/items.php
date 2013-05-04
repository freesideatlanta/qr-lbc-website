<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->load->model('items_model');
		//$this->layout->placeholder("title","Lifecycle Building Center");
	}
	
	public function index()
    {
		$data['items'] = $this->items_model->getAllItems();
		
		$this->load->view('templates/header', $data);
		$this->load->view('items/index', $data);
		$this->load->view('templates/footer', $data);		
	}
}
