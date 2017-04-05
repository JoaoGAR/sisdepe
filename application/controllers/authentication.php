<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class authentication extends CI_Controller 
{
	public function log_out()
	{
		$this->session->unset_userdata("user_logged_in");
		redirect("/");
	}
	public function authenticate_user()
	{
		$this->load->model("user_model");
		$this->load->model("job_model");
		$this->load->helper('date');

		$login = $this->input->post("login");
		$password = $this->input->post("password");

		if (empty($login) || empty($password)) {
			$this->session->set_flashdata("empty-data-login-senha" , "err");
			redirect("/");
		} 
		else 
		{
			$user = $this->user_model->authenticate($login, $password);

			if ($user) {
				$this->session->set_flashdata("success-login" , "success");
				$this->session->set_userdata("user_logged_in" , $user);

				$jobs = $this->job_model->get_jobs($this->session->userdata("user_logged_in")["user_id"]);

				$stringdedata = "%Y-%m-%d %h:%i:%s";
				$date = time();

				$date_time = mdate($stringdedata, $date);

				foreach ($jobs as $job) 
				{
					echo "<hr>";
					echo "<p>".$job['job_name']."</p>";
					echo $job['job_end_date'];
					echo "<p>-=-=-=-=-</p>";
					echo $date_time;
					echo "<hr>";

					if ($job['job_end_date'] < $date_time && $job['job_status'] == 0) 
					{
						$this->job_model->update_job_status($job['job_id'],3);
					}
				}

				redirect("user/load_feed");
			}
			else{
				$this->session->set_flashdata("err-login" , "err");
				redirect("/");
			}
		}
	}

	public function register_company()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		//$this->form_validation->set_rules('cidade', 'Cidade', 'required');
		//$this->form_validation->set_rules('bairro', 'Bairro', 'required');
		//$this->form_validation->set_rules('rua', 'Rua', 'required');
		//$this->form_validation->set_rules('numero', 'Nº', 'required');
		//$this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$this->form_validation->set_message('required', '<span class="glyphicon glyphicon-exclamation-sign"></span> Este campo é obrigatorio.');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("register/company_register");
		}
		else
		{
			$this->load->model("user_model");
			$userData = array(
				//"cadastroestadual" => $this->input->post("cadastroestadual"),
				"user_name" => $this->input->post("nome"),
				"user_email" => $this->input->post("email"),
				//"telefone" => $this->input->post("telefone"),
				"user_login" => $this->input->post("login"),
				"user_password" => $this->input->post("senha"),
				);
			$result = $this->user_model->register($userData);

			if ($result) 
			{
				$this->session->set_userdata("loged_user" , $userData);
				redirect('user/load_feed');
			} 
			else 
			{
				$this->session->set_flashdata("err-regist" , "err");
				redirect('authentication/register_company');
			}
		}
	}

	public function register_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		//$this->form_validation->set_rules('cidade', 'Cidade', 'required');
		//$this->form_validation->set_rules('bairro', 'Bairro', 'required');
		//$this->form_validation->set_rules('rua', 'Rua', 'required');
		//$this->form_validation->set_rules('numero', 'Nº', 'required');
		//$this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$this->form_validation->set_message('required', '<span class="glyphicon glyphicon-exclamation-sign"></span> Este campo é obrigatorio.');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("register/user_register");
		}
		else
		{
			$this->load->model("user_model");
			$userData = array(
				//"cadastroestadual" => $this->input->post("cadastroestadual"),
				"user_name" => $this->input->post("nome"),
				"user_email" => $this->input->post("email"),
				//"telefone" => $this->input->post("telefone"),
				"user_login" => $this->input->post("login"),
				"user_password" => $this->input->post("senha"),
				"user_type" => 1,
				"user_company_id" => $this->session->userdata("user_logged_in")["user_id"]
				);
			$result = $this->user_model->register($userData);

			if ($result) 
			{
				$this->session->set_flashdata("succee-regist-user" , "succ");
				redirect('authentication/register_user');
			} 
			else 
			{
				$this->session->set_flashdata("err-regist-user" , "err");
				redirect('authentication/register_user');
			}
		}
	}

}