<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class A extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->Model('Model_trade');
		$this->_secure();
	}

	private function _secure () {
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
	}

	function index()
	{
		$data['title'] = 'Tosen';
		$this->load->view('dash/index', $data);
	}

	function add()
	{
		$data['title'] = 'Tosen';
		$this->load->view('dash/add', $data);
	}

	function update()
	{
		$data['title'] = 'Tosen';
		$this->load->view('dash/update', $data);
	}

	function show($type = 'cfd')
	{
		$data['title'] = 'Tosen';
		$data['type'] = $type;
		$this->load->view('dash/show', $data);
	}

	function get_trade_item($type = 'cfd', $broker = 1)
	{
		$user_id = $this->tank_auth->get_user_id();
		$type = strtolower($type);
		$instruments = $this->Model_trade->get_instruments_with_margin($broker, $type);
		$data['currency'] = 'R';
		$data['fee'] = '0.004';
		$data['instrument'] = $instruments->result();
		$this->load->view('dash/_trade_item', $data);
	}

	function trade_add ($type = 'cfd') {
		$data = array(
					'user_id' => $this->tank_auth->get_user_id(),
					'instrument' => trim($this->input->post('instrument')),
					'direction' => $this->input->post('direction'),
					'current' => $this->input->post('current'),
					'open' => $this->input->post('open'),
					'stop' => $this->input->post('stop'),
					'limit' => $this->input->post('limit'),
					'spread' => $this->input->post('spread'),
					'margin' => $this->input->post('margin'),
					'fee' => $this->input->post('fee'),
					'amount' => $this->input->post('amount'),
					'shares' => $this->input->post('shares'),
					'profit' => $this->input->post('profit'),
					'loss' => $this->input->post('loss'),
					'profit_real' => $this->input->post('profitReal'),
					'loss_real' => $this->input->post('lossReal'),
					'net_profit_real' => $this->input->post('netProfitReal'),
					'net_loss_real' => $this->input->post('netLossReal')
		);
		$id = $this->Model_trade->insert_user_trade($data, $type);
		if ($id > 0) {
			echo json_encode(array("success" => 1));
		} else {
			echo json_encode(array("success" => 0));
		}
	}

	function get_all_user_trades ($type = 'cfd') {
		$trades = $this->Model_trade->get_all_trades_per_user($this->tank_auth->get_user_id(), $type);
		$data['trades'] = $trades->result();
		$this->load->view('dash/all_trades', $data);
	}

	function edit_trade ($id, $type = 'cfd') {
		$trade = $this->Model_trade->get_trade($id, $this->tank_auth->get_user_id(), $type)->result();
		$data['trade'] = $trade[0];
		$data['title'] = 'Tosen';
		$data['currency'] = 'R';
		$this->load->view('dash/edit_trade', $data);
	}

	function update_trade ($type = 'cfd') {
		$data = array (
					'id' => $this->input->post('id'),
					'user_id' => $this->tank_auth->get_user_id(),
					'active' => $this->input->post('active'),
					'result' => $this->input->post('result')
		);
		$res = $this->Model_trade->update_user_trade($data, $type);
		if ($res) {
			echo json_encode(array("success" => 1));
		} else {
			echo json_encode(array("success" => 0));
		}
	}
}


/* End of file a.php */
/* Location: ./application/controllers/a.php */
