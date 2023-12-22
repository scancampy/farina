<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Home';
		$data['slides'] = $this->admin_model->getSlides(array('is_deleted' => 0));
		$data['event'] = $this->event_model->getEvent(array('is_deleted' => 0, 'event_date >= ' => date('Y-m-d')),null,null,null, 'asc');

		$data['info'] = $this->info_model->getInfoAll();

		if(count($data['event']) > 0) {
			$data['photo'] = $this->event_model->getImageEvent(null, $data['event'][0]->id);
		}

		

		$data['article'] = $this->article_model->getArticle(array('article.is_deleted' => 0), null, 3);
		$data['brand'] = $this->product_model->getBrand('is_deleted = 0',null,'id','RANDOM',6);

		$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0), null, 6, null, 'RANDOM');
		if(count($data['product']) >0 ) {
			$data['photo_product'] = array();
			foreach ($data['product'] as $key => $value) {
				$data['photo_product'][$key] = $this->product_model->getImageProduct(null, $value->id);
			}
		}


		$data['photo_article'] = array();

		foreach ($data['article'] as $key => $value) {
			$data['photo_article'][] = $this->article_model->getImageArticle(null, $value->id);
		}

		$this->load->view('v_header', $data);
		$this->load->view('v_home',$data);
		$this->load->view('v_footer', $data);
	}
}
