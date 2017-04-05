<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class team extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("user_logged_in")) 
		{
			$this->session->set_flashdata("user_not_logged_in" , "err");
			redirect('/');
		}
	}

	public function create_group()
	{
		$this->load->model("user_model");
		$this->load->model("team_model");

		$this->load->library('form_validation');
		$this->form_validation->set_rules('group_name', 'Group_name', 'required');
		$this->form_validation->set_rules('group_leader', 'Group_leader', 'required');
		$this->form_validation->set_message('required', '<span class="glyphicon glyphicon-exclamation-sign"></span> Este campo é obrigatorio.');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$users = $this->user_model->load_employees($this->session->userdata("user_logged_in")["user_id"]);

			$data = array(
				'users' => $users
				);
			
			$this->load->view("system/team_create", $data);
		}
		else
		{
			$group_name = $this->input->post("group_name");
			$group_leader = $this->input->post("group_leader");
			$group_members = $this->input->post("group_members");

			$group_members[] .= $group_leader;

			$data = array(
				'group_name' => $group_name,
				'group_leader' => $group_leader,
				'company_id' => $this->session->userdata("user_logged_in")["user_id"]
				);

			$group_id = $this->team_model->create_team($data);
			$this->user_model->set_group_leader($group_leader);

			foreach ($group_members as $group_member) {
				$fields = array(
					'group_id' => $group_id,
					'user_id' => $group_member
					);
				$this->team_model->create_user_group($fields);
			}
			redirect("team/create_group");
		}
	}

	public function list_groups()
	{
		$this->load->model("team_model");
		$this->load->model("user_model");
		$groups = $this->team_model->load_teams($this->session->userdata("user_logged_in")["user_id"]);

		for ($i=0; $i < sizeof($groups); $i++) 
		{ 
			$groups[$i]['group_leader'] = $this->user_model->select_user_name($groups[$i]["group_leader"])["user_name"];
		}

		$data = array(
			'groups' => $groups
			);

		$this->load->view("system/list_groups", $data);
	}

	public function load_groups()
	{
		$this->load->model("team_model");
		$this->load->model("user_model");

		$groups = $this->team_model->load_my_groups($this->session->userdata("user_logged_in")["user_id"]);

		echo json_encode($groups);
	}

	public function load_team_members()
	{
		$this->load->model("team_model");
		$this->load->model("user_model");
		$team_id = $this->input->get("team_id");

		$members = $this->team_model->select_team_members($team_id);

		for ($i=0; $i < sizeof($members); $i++) 
		{ 
			$members[$i]['user_id'] = $this->user_model->select_user_name($members[$i]['user_id'])["user_name"];
		}

		echo json_encode($members);
	}
}