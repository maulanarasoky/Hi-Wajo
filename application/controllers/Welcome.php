<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index');
	}
	public function login() {
		$this->form_validation->set_rules("username", "username", "trim|required|xss_clean");
		$this->form_validation->set_rules("password", "password", "trim|required|xss_clean|callback_check_database");
		if($this->form_validation->run() == false){
			$this->load->view('login');

		}else {
			redirect('dashboard', 'refresh');
		}
	}
	public function check_database($password){
		$user = $this->input->post('username');
		$result = $this->main_model->get_user($username, $password);
		$this->display($result);
		if($result){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
				redirect('dashboard');
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database', '<div class="alert alert-danger text-center">Invalid username or password!</div>');
			return false;
		}
	}
}
