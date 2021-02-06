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
		$this->load->view('admin/v_login');
	}
}
