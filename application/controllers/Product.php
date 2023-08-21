<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	// function to recursively extract ids from nested child arrays
	private function _traverseArrayForIds($array) {
	    $ids = [];
	    foreach ($array as $item) {
	        $ids[] = $item->id;
	        if (!empty($item->child)) {
	            $childIds = traverseArrayForIds($item->child);
	            $ids = array_merge($ids, $childIds);
	        }
	    }
	    return $ids;
	}

	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Product';
		$limit = 12;
		$offset = 0;


		$data['category'] = $this->category_model->getCategory(null);
		$cat =null;

		if($this->input->get('category') != null) {
			$explode = explode('-',$this->input->get('category'));
			$cat = $this->category_model->getCategoryTree($explode[0]);

			$data['category'] = $this->category_model->getCategory($explode[0]);
			$data['breadcrumb'] = $this->category_model->getRoot($explode[0]);
			//print_r($data['breadcrumb']);

			$data['current_cat'] = $this->category_model->getCategoryById($explode[0]);

			//print_r($cat);
			// new array to store only ids
			$newArray = [];
			$newArray[] = $explode[0];

			if(!empty($cat)) {
				// iterate over original array
				foreach ($cat as $item) {
				    // extract id value and add it to new array
				    $newArray[] = $item->id;
				    
				    // if item has children, recursively extract their ids and add to new array
				    if (!empty($item->child)) {
				        $childIds = $this->_traverseArrayForIds($item->child);
				        $newArray = array_merge($newArray, $childIds);
				    }
				}
			}
		}


		if($this->input->get('o') != null) {
			$offset = (int) $this->input->get('o');
		} 

		$wherestr = '';
		if($this->input->get('category') != null) {
			$str = '';
			foreach ($newArray as $value) {
			  $str .= "'" . $value . "', ";
			}
			$str = rtrim($str, ', ');
			$wherestr = ' product.category_id IN ('.$str.') AND product.is_deleted = 0';
		}

		if($this->input->get('brand') != null) {
			if($this->input->get('brand') != 'all') {

				$data['currentbrand'] = $this->product_model->getBrand(array('id' => $this->input->get('brand'),'is_deleted' => 0));
				if($wherestr != '') {
					$wherestr = ' AND '.$wherestr;
				}

				$data['product'] = $this->product_model->getProduct('product.brand_id = "'.$this->input->get('brand').'" '.$wherestr, null, $limit, $offset);
				$data['total'] = $this->product_model->getProduct('product.brand_id = "'.$this->input->get('brand').'" '.$wherestr);
		
			} else {
				//echo $wherestr;
				$data['product'] = $this->product_model->getProduct($wherestr,null, $limit, $offset);
				$data['total'] = $this->product_model->getProduct($wherestr);
			}
		} else {

			$data['product'] = $this->product_model->getProduct($wherestr, null, $limit, $offset);
			$data['total'] = $this->product_model->getProduct($wherestr);
		
		}

		if(count($data['product']) >0 ) {
			$data['photo'] = array();
			$data['ratingproduct'] = array();
			$data['numrating'] = array();
			foreach ($data['product'] as $key => $value) {
				$data['photo'][$key] = $this->product_model->getImageProduct(null, $value->id);
				$data['ratingproduct'][$key] = $this->trans_model->getProductRating($value->id);
				$data['numrating'][$key] = $this->trans_model->getProductRatingNumber($value->id);
			}
		}

		$this->load->library('pagination');

		$producturl = 'product';
		if($this->input->get('brand') != null) {
			$producturl = '?brand='.$this->input->get('brand');
		}

		if($this->input->get('category') != null) {
			$caturl = 'category='.$this->input->get('category');
			if($producturl != 'product') { $producturl .= '&'.$caturl; } else  { $producturl .= '?'.$caturl; }			
		}
		
		$config['base_url'] = base_url($producturl); //http://example.com/index.php/test/
		
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'o';

		$config['total_rows'] = count($data['total']);
		$config['per_page'] = 12;
		$config['prev_tag_open'] = '<li class="pagination__item pagination__item--prev">';
		$config['prev_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li style="margin-left:10px;" class="pagination__item pagination__item--prev">';
		$config['last_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li style="margin-left:10px;" class="pagination__item pagination__item--prev">';
		$config['first_tag_close'] = '</li>';

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
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Product Detail';

		$data['js'] = '';
		$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0), $id);

		if(empty($data['product'])) {
			redirect('notfound');
		}
		$data['brand'] = $this->product_model->getBrand('', $data['product'][0]->brand_id);
		
		$data['breadcrumb'] = $this->category_model->getRoot($data['product'][0]->category_id);

		$data['ratings'] = $this->trans_model->getProductRating($id);
		$data['total'] = $this->trans_model->getProductRatingNumber($id);
		$data['reviews'] = $this->trans_model->getProductReview($id);
		

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
