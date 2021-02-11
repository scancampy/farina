<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		$data = array();

		if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}
	}

	public function login() {
		$data = array();
		if($this->input->post('btnlogin')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->admin_model->login($username, $password);

			if($user) {
				$this->session->set_userdata('user', $user);
			} else {
				$this->session->set_flashdata('notiferror', 'true');
				redirect('admin/dashboard/login');
			}
		}

		if($this->session->flashdata('notif')) {
			$data['notiferror'] = 'error';
		}
		$this->load->view('admin/v_login', $data);
	}
}
