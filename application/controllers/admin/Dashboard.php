<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index()
	{
		$data = array();

		if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Dashboard";

		$data['trans'] = $this->trans_model->getTransWhere('trans.status="order_placed" AND trans.payment_confirmation_date IS NOT NULL AND trans.is_cancelled IS NULL');

		//print_r($data['trans']);

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_dashboard', $data);
		$this->load->view('admin/v_footer', $data);

	}

	public function signout() {
		$this->session->sess_destroy();
		redirect('admin/dashboard/login');
	}

	public function login() {
		$data = array();

		if($this->session->userdata('user')) {
			redirect('admin/dashboard');
		}

		if($this->input->post('btnlogin')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->admin_model->login($username, $password);

			if($user) {
				$this->session->set_userdata('user', $user);
				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('notiferror', 'true');				
				redirect('admin/dashboard/login');
			}
		}

		if($this->session->flashdata('notiferror')) {
			$data['notiferror'] = 'error';
		}
		$this->load->view('admin/v_login', $data);
	}
}
