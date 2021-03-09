<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Page Not Found';
		$this->load->view('v_header', $data);
		$this->load->view('v_notfound', $data);
		$this->load->view('v_footer', $data);
	}

}
