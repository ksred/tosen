<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if ($this->tank_auth->is_logged_in()) {
			$data['title'] = "Tosen";
			$this->load->view('dash/index', $data);
		} else {
			$data['title'] = "Tosen";
			$this->load->view('landing', $data);
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
