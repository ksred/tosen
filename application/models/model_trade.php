<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_trade extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database("default", TRUE);
	}

	function insert_user_trade ($data, $type) {
		$table = "user_trade_".$type;
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function get_instruments ($broker, $type) {
		$table = "trade_".$type;
		$this->db->select("symbol, name");
		$this->db->from($table);
		$this->db->where("broker_id", $broker);
		$result = $this->db->get();
		return $result;
	}

	function get_instruments_with_margin ($broker, $type) {
		$table = "trade_".$type;
		$this->db->select("t.symbol, t.name, m.margin");
		$this->db->from($table." as t, broker_margins as m");
		$this->db->where("t.broker_id", $broker);
		$this->db->where("m.type", $type);
		$this->db->where("m.broker_id = t.broker_id");
		$this->db->where("m.instrument = t.symbol");
		$result = $this->db->get();
		return $result;
	}

	function get_all_trades_per_user ($user, $type) {
		$table = "user_trade_".$type;
		$this->db->select("*");
		$this->db->from($table." as t, trade_result as r");
		$this->db->where("t.user_id", $user);
		$this->db->where("t.result = r.result_id");
		$this->db->order_by('date_open', 'desc');
		$result = $this->db->get();
		return $result;
	}

	function get_trade ($id, $user, $type) {
		$table = "user_trade_".$type;
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where("user_id", $user);
		$this->db->where("id", $id);
		$result = $this->db->get();
		return $result;
	}



}

/* End of file model_trade.php */
/* Location: ./application/models/,odel_trade.php */
