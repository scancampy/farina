<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	public function index() {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['selectedcatid'] = 'all';
		
		if($this->input->get('catid')) {
			$catid = (int) $this->input->get('catid');
			$data['article'] = $this->article_model->getArticle(array('article.is_deleted' => 0, 'article.is_published' => 1,'article.category_id' => $catid));	
			$data['selectedcatid'] = $catid;
		} else {
			$data['article'] = $this->article_model->getArticle(array('article.is_deleted' => 0, 'article.is_published' => 1));	
		}
		

		$data['photo'] = array();

		foreach ($data['article'] as $key => $value) {
			$data['photo'][] = $this->article_model->getImageArticle(null, $value->id);
		}


		$data['title'] = 'Beauty Article';
		$data['category'] = $this->article_model->getCategory(array('is_deleted' => 0));

		$this->load->view('v_header', $data);
		$this->load->view('v_article',$data);
		$this->load->view('v_footer', $data);
	}

	public function read($id, $title = null)
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		

		$idc = (int) $id;

		$data['article'] = $this->article_model->getArticle(array('article.is_deleted' => 0, 'article.is_published' => 1), $idc);	
		$data['photo'] = $this->article_model->getImageArticle(null, $idc);
		if(count($data['article']) == 0) {
			redirect('notfound');
		}

		$data['title'] = $data['article'][0]->title;

		$data['js'] = 'var x = new Splide( ".splide" ).mount();';

		$this->load->view('v_header', $data);
		$this->load->view('v_article_read',$data);
		$this->load->view('v_footer', $data);
	}

}
