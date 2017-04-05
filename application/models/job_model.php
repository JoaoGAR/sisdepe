<?php
class job_model extends CI_Model
{
	public function create_job($data)
	{
		$this->db->insert("job", $data);
		return $this->db->insert_id();
	}

	public function load_jobs($owner_id)
	{
		$this->db->where("job_owner", $owner_id);
		return $this->db->get("job")->result_array();
	}

	public function get_jobs($owner_id)
	{
		$this->db->where("job_user_id", $owner_id);
		$this->db->order_by('job_init_date', 'DESC');
		return $this->db->get("job")->result_array();
	}

	public function load_my_jobs($owner_id)
	{
		$this->db->where("job_user_id", $owner_id);
		$this->db->where("job_group_id", 0);
		$this->db->order_by('job_init_date', 'DESC');
		return $this->db->get("job")->result_array();
	}

	public function load_job_info($job_id)
	{
		$this->db->where("job_id", $job_id);
		return $this->db->get("job")->row_array();
	}

	public function load_group_jobs($group_id, $user_id)
	{
		$this->db->where("job_group_id", $group_id);
		$this->db->where("job_user_id", $user_id);
		return $this->db->get("job")->result_array();
	}

	public function update_job_status($job_id, $status)
	{
		
		$this->db->where("job_id", $job_id);
		$data = $this->db->get("job")->row_array();

		if ($status == 1) 
		{
			$this->load->helper('date');

			$stringdedata = "%Y-%m-%d %h:%i:%s";
			$date = time();

			$date_time = mdate($stringdedata, $date);
			$data['job_conclude_date'] = $date_time;
		}

		$data['job_status'] = $status;

		$this->db->where("job_id", $job_id);

		$this->db->update("job", $data);
	}

	public function load_boss_jobs($leader_id)
	{
		$this->db->select("group_id");
		$this->db->where("group_leader", $leader_id);
		$group_id = $this->db->get("team")->row_array();

		$this->db->where("job_group_id", $group_id['group_id']);
		return $this->db->get("job")->result_array();
	}
	public function insert_job_rate($data)
	{
		$this->load->helper('date');

		$stringdedata = "%Y-%m-%d %h:%i:%s";
		$date = time();

		$date_time = mdate($stringdedata, $date);

		$this->db->where("job_id", $data['job_id']);
		$job = $this->db->get("job")->row_array();

		$data = array(
			'user_id' => $job['job_user_id'],
			'job_id' => $job['job_id'],
			'leader_id' => $this->session->userdata("user_logged_in")["user_id"],
			'user_rate' => $data['user_rate'],
			'evaluation_end_date' => $date_time
			);

		$this->db->insert("user_rate", $data);
	}
}