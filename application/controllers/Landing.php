<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
	public function index()
	{
		$data = array();
		

		$this->load->view('v_landing', $data);
	}
}
