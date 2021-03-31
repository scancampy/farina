<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function index()
	{
		if(!$this->session->userdata('member')) {
			redirect('member/signin');
		} else {
			echo 'render dashboard';
		}
	}

	public function signin() {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Sign In';

		if($this->input->post('btnsubmit')) {
			$result = $this->member_model->login($this->input->post('email'), $this->input->post('password'));

			if($result) {
				$this->session->set_userdata('member', $result);
				redirect('member');
			} else {
				// TODO: bikin notif error
			}
		}

		$this->load->view('v_header', $data);
		$this->load->view('v_sign_in',$data);
		$this->load->view('v_footer', $data);
	}

	public function signup() {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Sign Up';

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('repeat_password', 'Repeat Pasword', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]');

        if ($this->form_validation->run() == FALSE)
        {
        	$data['error'] = validation_errors();
        } else {
        	if($this->input->post('btnsubmit')) {
	        	if($this->input->post('check_aggreement')) {
	        	

	        		if($this->member_model->signup($this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('password'), $this->input->post('email'), $_GET['refcode'])) {
	        			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Pendaftaran member sukses. Kami mengirimkan link kode aktivasi member ke email anda. Pastikan anda dapat mengakses link tersebut untuk mengaktifkan member anda.'));
	        		} else {
	        			$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Pendaftar member gagal dilakukan karena email telah terdaftar.'));
	        		}

	        		redirect('member/signup');
	        	} else {
	        		$data['error'] = '<li>Anda harus menyetujui syarat dan ketentuan</li>';
	        	}
	        }
        }
		$this->load->view('v_header', $data);
		$this->load->view('v_sign_up',$data);
		$this->load->view('v_footer', $data);
	}
}
