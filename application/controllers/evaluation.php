<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class evaluation extends CI_Controller 
{
	public function view_evaluation()
	{
		$this->load->model("evaluation_model");
		$this->load->model("job_model");
		$this->load->model("user_model");

		$evaluations = $this->evaluation_model->get_evaluation($this->session->userdata("user_logged_in")["user_id"]);
		
		for($i = 0;$i < sizeof($evaluations); $i++)
		{

			$job_info = $this->job_model->load_job_info($evaluations[$i]['job_id']);
			$user_name = $this->user_model->select_user_name($evaluations[$i]['leader_id']);

			$evaluations[$i]['leader_id'] = $user_name['user_name'];
			$evaluations[$i]['job_id'] = $job_info['job_name'];
			$evaluations[$i]['job_importance'] = $job_info['job_importance'];

			
		}

		$data = array("evaluations"=> $evaluations);
		$this->load->view("system/view_evaluations",$data);
	}
}