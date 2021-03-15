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

	public function details($id) {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		

		$idc = (int) $id;

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

}
