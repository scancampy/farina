<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Event';
		$data['event'] = $this->event_model->getEvent(array('is_deleted' => 0, 'event_date >= '=> date('Y-m-d')), null, null, null, 'asc');
		$data['photo'] = array();

		foreach ($data['event'] as $key => $value) {
			$data['photo'][] = $this->event_model->getImageEvent(null, $value->id);
		} 
		$this->load->view('v_header', $data);
		$this->load->view('v_timeline', $data);
		$this->load->view('v_footer', $data);
	}

	private function _check_token($token) {
    	$secret_key = "6LdODPMlAAAAAEfgDO4mxkdSwflCqLvstgrf2dTp";
	    // call curl to POST request 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secret_key, 'response' => $token)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$arrResponse = json_decode($response, true);

		if($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.5) {
			return false;
		    // valid submission 
		    // go ahead and do necessary stuff 
		} else {
			return true;
		}
    }

	public function details($id) {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$idc = (int) $id;
		if(empty($this->session->userdata('member'))) {
          	$data['member'] = false;
        } else {
        	$data['member'] = true;
        	$m = $this->session->userdata('member');
        	
        	$member = $this->member_model->getMember($m->email);
        	// get if member registered
			$data['registrant'] = $this->event_model->getRegister($idc, $member[0]->id);
        }
		
		$data['event'] = $this->event_model->getEvent(array('is_deleted' => 0), $idc);	
		$data['photo'] = $this->event_model->getImageEvent(null, $idc);
		if(count($data['event']) == 0) {
			redirect('notfound');
		}

		$data['title'] = $data['event'][0]->name;

		$data['js'] = 'var x = new Splide( ".splide" ).mount();';

		$this->load->view('v_header', $data);
		$this->load->view('v_event_detail', $data);
		$this->load->view('v_footer', $data);
	}

	public function register($id, $name='') {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		if(empty($this->session->userdata('member'))) {
          	redirect('notfound');
        } 
		
		// load member
		$member = $this->session->userdata('member');
		$data['member'] = $this->member_model->getMember($member->email);

		$idc = (int) $id;

		$data['event'] = $this->event_model->getEvent(array('is_deleted' => 0), $idc);	
		$data['photo'] = $this->event_model->getImageEvent(null, $idc);
		if(count($data['event']) == 0) {
			redirect('notfound');
		} else if($data['event'][0]->need_registration != true) {
			redirect('notfound');
		}

		// get if member registered
		$data['registrant'] = $this->event_model->getRegister($idc, $data['member'][0]->id);


		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
			$data['msg'] = $this->session->flashdata('msg');
		}

		if($this->session->flashdata('notifsuccess')) {
			$data['notifsuccess'] = $this->session->flashdata('notifsuccess');
			$data['msg'] = $this->session->flashdata('msg');
		}

		if($this->input->post('btnsubmit')) {
			// phone 
			$phone = trim($this->input->post('phone'));

			if($phone == '') {
				$this->session->set_flashdata('notif', 'error');
				$this->session->set_flashdata('msg', 'Phone number is required');
				redirect('event/register/'.$idc.'/'.url_title($data['event'][0]->name));
			}

			// Set preference
			$config['upload_path'] = './images/payment_proof'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '10000'; // max_size in kb
			$config['encrypt_name'] = true;

			//Load upload library
			$this->load->library('upload',$config); 

			// File upload
			if($this->upload->do_upload('buktibayar')){
				// Get data about the file
				$uploadData = $this->upload->data();
				$filename = $uploadData['file_name'];

				$this->event_model->register($idc,$data['member'][0]->id, $this->input->post('phone'), $filename);
				$this->session->set_flashdata('notifsuccess', 'success');
				$this->session->set_flashdata('msg', 'We have received your registration payment proof successfully. Our team will now process your payment and proceed with your registration request.');
				redirect('event/register/'.$idc.'/'.url_title($data['event'][0]->name));
			} else {
				//die();
				$this->session->set_flashdata('notif', 'error');
				$this->session->set_flashdata('msg', 'Please upload payment proof (bukti bayar).');
				redirect('event/register/'.$idc.'/'.url_title($data['event'][0]->name));
			}
		}


		$data['title'] = $data['event'][0]->name;

		$data['js'] = 'var x = new Splide( ".splide" ).mount();';

		$this->load->view('v_header', $data);
		$this->load->view('v_event_register', $data);
		$this->load->view('v_footer', $data);
	}

}
