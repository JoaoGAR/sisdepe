<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller 
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

	public function list_employees()
	{
		$this->load->model("user_model");
		$users = $this->user_model->load_employees($this->session->userdata("user_logged_in")["user_id"]);

		$data = array(
			'users' => $users
			);

		$this->load->view("system/employees", $data);
	}

	public function load_feed()
	{
		$this->load->model("job_model");

		$jobs = $this->job_model->load_my_jobs($this->session->userdata("user_logged_in")["user_id"]);

		$data = array(
			'jobs' => $jobs
			);

		$this->load->view("system/feed", $data);
	}

	public function list_employees_json()
	{
		$this->load->model("user_model");
		$users = $this->user_model->load_employees($this->session->userdata("user_logged_in")["user_id"]);

		echo json_encode($users);
	}
}