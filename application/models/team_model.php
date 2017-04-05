<?php
class team_model extends CI_Model
{
	public function load_teams($company_id) 
	{
		$this->db->where("company_id", $company_id);
		$this->db->or_where("group_leader", $company_id);
		return $this->db->get("team")->result_array();
	}

	public function select_team_members($team_id) 
	{
		$this->db->select("user_id");
		$this->db->where("group_id", $team_id);
		return $this->db->get("user_group")->result_array();
	}
	public function create_team($data)
	{
		$this->db->insert("team", $data);
		return $this->db->insert_id();
	}
	public function create_user_group($data)
	{
		$this->db->insert("user_group", $data);
		return $this->db->insert_id();
	}
	public function select_group_name($user_id)
	{
		$this->db->select("group_name");
		$this->db->where("group_id", $user_id);
		return $this->db->get("team")->row_array();
	}

	public function load_my_groups($user_id)
	{
		$this->db->select("group_id");
		$this->db->where("user_id", $user_id);
		$groups_ids = $this->db->get("user_group")->result_array();

		foreach ($groups_ids as $group_id) 
		{
			$this->db->where("group_id", $group_id['group_id']);
			$groups[] = $this->db->get("team")->row_array();
		}
		
		return $groups;
	}
}