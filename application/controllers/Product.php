<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function index()
	{
		$data = array();
		$this->load->view('v_home');
	}

	public function detail($id) {
		$realid = (int) $id;
		$data = array();
		$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0), $id);
		

		if(count($data['product']) >0) {
			$data['photo'] = $this->product_model->getImageProduct(null, $id);
		} else {
			// todo: create custom not found view and controller
			echo 'not found';
			die();
		}

		$this->load->view('v_product',$data);
	}
}
