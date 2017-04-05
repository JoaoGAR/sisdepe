<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class job extends CI_Controller 
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

	public function create_job()
	{
		$this->load->model("user_model");
		$this->load->model("team_model");
		$this->load->model("job_model");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('job_name', 'Job_name', 'required');
		$this->form_validation->set_rules('jop_destiny_id', 'Jop_destiny_id', 'required');
		$this->form_validation->set_rules('job_description', 'Job_description', 'required');
		$this->form_validation->set_rules('job_end_date', 'Job_end_date', 'required');
		$this->form_validation->set_message('required', '<span class="glyphicon glyphicon-exclamation-sign"></span> Este campo é obrigatorio.');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$groups = $this->team_model->load_teams($this->session->userdata("user_logged_in")["user_id"]);
			$users = $this->user_model->load_employees($this->session->userdata("user_logged_in")["user_id"]);

			$data = array(
				'users' => $users,
				'groups' => $groups
				);

			$this->load->view("system/job_create", $data);
		}
		else
		{
			$job_destiny_id = explode(",", $this->input->post('jop_destiny_id'));

			if ($job_destiny_id[1] == 'job_group_id') 
			{
				$users_id = $this->team_model->select_team_members($job_destiny_id[0]);

				foreach ($users_id as $user_id) 
				{
					$job_content = array(
						'job_name' => $this->input->post('job_name'),
						'job_user_id' => $user_id['user_id'],
						'job_description' => $this->input->post('job_description'),
						'job_end_date' => $this->input->post('job_end_date'),
						'job_owner' => $this->session->userdata("user_logged_in")["user_id"],
						'job_group_id' => $job_destiny_id[0],
						'job_importance' => $this->input->post('job_importance')
						);

					$job_id = $this->job_model->create_job($job_content);
				}
			}
			else
			{
				$job_content = array(
					'job_name' => $this->input->post('job_name'),
					'job_user_id' => $job_destiny_id[0],
					'job_description' => $this->input->post('job_description'),
					'job_end_date' => $this->input->post('job_end_date'),
					'job_owner' => $this->session->userdata("user_logged_in")["user_id"]
					);
				$job_id = $this->job_model->create_job($job_content);
			}
			
			if ($job_id) 
			{
				$this->session->set_flashdata("job-created" , "succss");
				redirect('job/create_job');
			}
			else
			{
				$this->session->set_flashdata("job-creation-error" , "errr");
				redirect('job/create_job');
			}
		}
	}

	public function list_jobs()
	{
		$this->load->model("job_model");
		$this->load->model("user_model");
		$this->load->model("team_model");
		

		if ($this->session->userdata("user_logged_in")["user_type"] == 2) 
		{
			$jobs = $this->job_model->load_boss_jobs($this->session->userdata("user_logged_in")["user_id"]);

			for($i = 0;$i < sizeof($jobs); $i++)
			{
				if ($jobs[$i]['job_group_id'] == 0) {
					$jobs[$i]['job_destiny_id'] = $this->user_model->select_user_name($jobs[$i]['job_user_id'])["user_name"];
				}
				else
				{
					$jobs[$i]['job_destiny_id'] = $this->team_model->select_group_name($jobs[$i]['job_group_id'])["group_name"];
				}
			}

			$data = array(
				'jobs' => $jobs
				);

			$this->load->view("system/list_jobs", $data);
		}
		else
		{
			$jobs = $this->job_model->load_jobs($this->session->userdata("user_logged_in")["user_id"]);

			for($i = 0;$i < sizeof($jobs); $i++)
			{
				if ($jobs[$i]['job_group_id'] == 0) {
					$jobs[$i]['job_destiny_id'] = $this->user_model->select_user_name($jobs[$i]['job_user_id'])["user_name"];
				}
				else
				{
					$jobs[$i]['job_destiny_id'] = $this->team_model->select_group_name($jobs[$i]['job_group_id'])["group_name"];
				}
			}

			$data = array(
				'jobs' => $jobs
				);

			$this->load->view("system/list_jobs", $data);
		}
	}

	public function load_group_jobs()
	{
		$group_id = $this->input->get('team_id');

		$this->load->model("job_model");
		$jobs = $this->job_model->load_group_jobs($group_id,$this->session->userdata("user_logged_in")["user_id"]);

		$data = array(
			'jobs' => $jobs
			);

		$this->load->view("system/feed", $data);
	}

	public function view_job()
	{
		$this->input->get('job_id');
		$this->load->model("job_model");
		$this->load->model("user_model");
		$this->load->model("team_model");

		$job_id = $this->input->get('job_id');

		$job = $this->job_model->load_job_info($job_id);

		if ($job['job_group_id'] != 0) 
		{
			$job['job_group_id'] = $this->team_model->select_group_name($job['job_group_id']);
		}
		$job['job_owner'] = $this->user_model->select_user_name($job['job_owner']);
		$job['job_user_id'] = $this->user_model->select_user_name($job['job_user_id']);

		echo json_encode($job);
	}

	public function conclude_job()
	{
		$this->load->model("job_model");
		$job_id = $this->input->post('job_id');
		$this->load->helper('date');

		$data = $this->job_model->update_job_status($job_id, 1);


		redirect('user/load_feed');
	}

	public function conclude_job_boss()
	{
		$this->load->model("job_model");
		$job_id = $this->input->get('job_id');
		$employee_rate = $this->input->get('employee_rate');

		$data = array(
			'job_id' => $job_id,
			'user_rate' => $employee_rate
			);

		$this->job_model->insert_job_rate($data);

		$this->job_model->update_job_status($job_id, 2);

		echo json_encode($data);
	}
}