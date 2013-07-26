<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class A extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$this->load->view('welcome', $data);
		}
	}
}

/* End of file a.php */
/* Location: ./application/controllers/a.php */
