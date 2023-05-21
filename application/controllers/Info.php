<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {
	public function index() {
		redirect('notfound');
	}

	public function view($id, $id2)
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Home';

		$data['info'] = $this->info_model->getInfo($id);
		if(empty($data['info'])) { redirect('notfound'); }

		$this->load->view('v_header', $data);
		$this->load->view('v_info',$data);
		$this->load->view('v_footer', $data);
	}
}
