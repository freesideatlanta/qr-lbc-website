<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Note: public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 */
	public function index()
	{
		$this->load->view('home');
	}
}

/* Location: ./application/controllers/welcome.php */
