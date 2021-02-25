<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function index()
	{
		$data = array();
		$limit = 12;
		$offset = 0;

		if($this->input->get('o') != null) {
			$offset = (int) $this->input->get('o');
		} 

		if($this->input->get('brand') != null) {
			if($this->input->get('brand') != 'all') {
				$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0, 'product.brand_id' => $this->input->get('brand')), null, $limit, $offset);
				$data['total'] = $this->product_model->getProduct(array('product.is_deleted' => 0, 'product.brand_id' => $this->input->get('brand')));
		
			} else {
				$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0),null, $limit, $offset);
				$data['total'] = $this->product_model->getProduct(array('product.is_deleted' => 0));
			}
		} else {
			$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0), null, $limit, $offset);
			$data['total'] = $this->product_model->getProduct(array('product.is_deleted' => 0));
		
		}

		if(count($data['product']) >0 ) {
			$data['photo'] = array();
			foreach ($data['product'] as $key => $value) {
				$data['photo'][$key] = $this->product_model->getImageProduct(null, $value->id);
			}
		}

		$this->load->library('pagination');

		if($this->input->get('brand') != null) {
			$config['base_url'] = base_url('product?brand='.$this->input->get('brand')); //http://example.com/index.php/test/page/';
		} else {
			$config['base_url'] = base_url('product'); //http://example.com/index.php/test/page/';
		}
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'o';

		$config['total_rows'] = count($data['total']);
		$config['per_page'] = 12;
		$config['prev_tag_open'] = '<li class="pagination__item pagination__item--prev">';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '<a href="#" class="pagination__item-link">Previous</a>';

		$config['cur_tag_open'] = '<li class="pagination__item pagination__item--current"><span class="pagination__item-link">';
		$config['cur_tag_close'] = '</span></li>';

		$config['num_tag_open'] = '<li class="pagination__item">';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class="pagination__item pagination__item--next">';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['attributes'] = array('class' => 'pagination__item-link');

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();

		$data['brand'] = $this->product_model->getBrand(array('is_deleted' => 0));
		$data['js'] = "$('select#brand').on('change', function() {
						$('#formcategory').submit();
					   });";



		$this->load->view('v_header', $data);
		$this->load->view('v_product',$data);
		$this->load->view('v_footer', $data);
	}

	public function detail($id) {
		$realid = (int) $id;
		$data = array();
		$data['js'] = '';
		$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0), $id);
		$data['variant'] = $this->product_model->getVariant(array('is_active' => 1, 'is_deleted' => 0),$id);
		//$this->load->helper('cookie');
		//delete_cookie('product');

		if($this->input->post('btnsubmit')) {
			$this->load->helper('cookie');
			// 
			// bantal A 
			// bantal B
			// bantal
			// cek apakah ada cookie
			if(unserialize(get_cookie('product')) != null) {
				//echo 'ada cookie';
				$idcek = null;
				$variantcek = null;
				$urutan  = null;
				$product = unserialize(get_cookie('product'));
				//echo 'jumproduct'.count($product);

				foreach ($product as $key => $value) {
				//	echo '<br/>urutan '.$key.'<br/>';
				//	print_r($value);
				//	echo '<br/>';
					if($value['id'] == $id) {
						
						// cek variant
						if($this->input->post('hidvariantchosen') != '') {
							if($value['variant'] == $this->input->post('hidvariantchosen')) {
								$variantcek = $this->input->post('hidvariantchosen');
								$urutan = $key;
								$idcek = $id;
								break;
							} 
						} else {
							$urutan = $key;
							$idcek = $id;
							break;
						}						
					}
				}

				if($idcek != null) {
					//echo 'masuk sini -> '.$urutan;
					//echo '<br/>';
					$product[$urutan]['qty'] =  $product[$urutan]['qty']+1;
				} else {
					//echo 'masuk sini';
					$prod = count($product);
					$product[$prod]['id'] = $id;
					$product[$prod]['variant'] = $this->input->post('hidvariantchosen');
					$product[$prod]['qty'] = 1;
				}
			} else {
				
				$product = array();
				$product[0]['id'] = $id;
				$product[0]['variant'] = $this->input->post('hidvariantchosen');
				$product[0]['qty'] = 1;
			}

			$cookie = array(
                'name'   => 'product',
                'value'  => serialize($product),
                'expire' =>  86500,
                'secure' => false
            );
            //print_r($product);
            //set_cookie($cookie); 
            //print_r(unserialize(get_cookie('product')));
			//die();
		}

		if(count($data['product']) >0) {
			$data['photo'] = $this->product_model->getImageProduct(null, $id);
		} else {
			// todo: create custom not found view and controller
			echo 'not found';
			die();
		}

		$data['js'] .= "
					   $('.variantobj').on('click',function() { 
						$('.variantobj').removeClass('selectedvariant');
						$(this).addClass('selectedvariant');
						var x = $(this).attr('attrid');
						$('#hidvariantchosen').val(x);
					   });";

		$this->load->view('v_header', $data);
		$this->load->view('v_product_detail',$data);
		$this->load->view('v_footer', $data);
	}
}
