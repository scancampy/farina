<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$data = array();
		$this->load->view('v_home');
	}

	public function coba() {
		echo 'as';
	}
}
