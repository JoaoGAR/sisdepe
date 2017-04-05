<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class evaluation_model extends CI_Model
{
	public function get_evaluation($user_id)
	{
		$this->db->where("user_id",$user_id);
		return $this->db->get("user_rate")->result_array();
	}
}