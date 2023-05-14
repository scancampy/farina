<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

	public function index()
	{
		if(!empty($this->input->get('activationtoken'))) {
			if($this->member_model->activatemember($this->input->get('activationtoken'))) {
				$this->session->set_flashdata('success', 'success');
				redirect('activation/success');
			}
		} else {
			redirect('notfound');
		}
	}

	public function success() {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Activation Success';
		$data['js'] = '';

		if(!$this->session->flashdata('success')) {
			redirect('notfound');
		}

		$this->load->view('v_header', $data);
		$this->load->view('v_activation_success',$data);
		$this->load->view('v_footer', $data);
	}	
}