<?php
class user_model extends CI_Model
{
	public function authenticate($login, $senha)
	{
		$this->db->where("user_login", $login);
		$this->db->where("user_password", $senha);
		$user =  $this->db->get("user")->row_array();
		return $user;
	}

	public function register($data)
	{
		$this->db->insert("user", $data);
		return $this->db->insert_id();
	}

	public function load_employees($user_company_id) 
	{
		if ($this->session->userdata("user_logged_in")["user_type"] == 2) 
		{
			$this->db->select("group_id");
			$this->db->where("group_leader", $user_company_id);
			$group_id = $this->db->get("team")->row_array();

			$this->db->where("group_id", $group_id['group_id']);
			$employeers_ids = $this->db->get("user_group")->result_array();

			foreach ($employeers_ids as $employeers_id) 
			{
				$this->db->where("user_id", $employeers_id['user_id']);
				$employeers[] = $this->db->get("user")->row_array();
			}
			return $employeers;
		}
		else
		{
			$this->db->where("user_company_id", $user_company_id);
			return $this->db->get("user")->result_array();
		}
	}

	public function select_user_name($user_id)
	{
		$this->db->select("user_name");
		$this->db->where("user_id", $user_id);
		return $this->db->get("user")->row_array();
	}

	public function set_group_leader($user_id)
	{
		$this->db->where("user_id", $user_id);
		$data = $this->db->get("user")->row_array();

		$data['user_type'] = 2;

		$this->db->where("user_id", $user_id);
		$this->db->update("user", $data);
	}
}