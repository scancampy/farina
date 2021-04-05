<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Community extends CI_Controller {
	public function index() {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['selectedcatid'] = 'all';

		$data['photo'] = array();

		/*foreach ($data['article'] as $key => $value) {
			$data['photo'][] = $this->article_model->getImageArticle(null, $value->id);
		}*/


		$data['title'] = 'Community';
		$data['slides'] = $this->admin_model->getSlides(array('is_deleted' => 0));
		
		$data['category'] = $this->article_model->getCategory(array('is_deleted' => 0));

		$this->load->view('v_header', $data);
		$this->load->view('v_community',$data);
		$this->load->view('v_footer', $data);
	}

	public function newpost() {
		if(!$this->session->userdata('member')) {
			redirect('notfound');
		}
	}

	

}
