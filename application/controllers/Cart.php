<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Cart';

		$this->load->helper('cookie');

		if($this->input->post('btnsubmit')) {
			
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
					if($value['id'] == $this->input->post('hidprodid')) {
						
						// cek variant
						if($this->input->post('hidvariantchosen') != '') {
							if($value['variant'] == $this->input->post('hidvariantchosen')) {
								$variantcek = $this->input->post('hidvariantchosen');
								$urutan = $key;
								$idcek = $this->input->post('hidprodid');
								break;
							} 
						} else {
							$urutan = $key;
							$idcek = $this->input->post('hidprodid');
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
					$product[$prod]['id'] = $this->input->post('hidprodid');
					$product[$prod]['variant'] = $this->input->post('hidvariantchosen');
					$product[$prod]['qty'] = 1;
				}
			} else {
				
				$product = array();
				$product[0]['id'] =  $this->input->post('hidprodid');
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
            set_cookie($cookie); 
            redirect('cart');
            //print_r(unserialize(get_cookie('product')));
			//die();
		}

		if($this->input->post('btnCancelVoucher')) {
			delete_cookie('voucher');
			redirect('cart'); 
		}

		if($this->input->post('btnApply')) {
			$code =  $this->input->post('voucher_code');
			$user = $this->session->userdata('member');

			if(isset($user)) {
				// kalau user sudah login
				if($this->voucher_model->checkVouhcerUsed($user->id, $code)) {
					$q = $this->voucher_model->getVoucher(array('voucher_type' => 'global', 'exp_date >=' => date('Y-m-d') ),$code);

					if(count($q) >0 ) {
						// ada voucher
						$data['voucher'] = $q;
					} else {
						// voucher tidak ada
						$this->session->set_flashdata('notif', array('result' => 'voucher_na', 'msg' => 'Voucher not valid'));
						redirect('cart');
					}
				} else {				
					$this->session->set_flashdata('notif', array('result' => 'voucher_na', 'msg' => 'Voucher have been used'));
					redirect('cart');
				}
			} else {
				// user belum login
				$q = $this->voucher_model->getVoucher(array('voucher_type' => 'global', 'exp_date >=' => date('Y-m-d') ),$code);

				if(count($q) >0 ) {
					// ada voucher
					$data['voucher'] = $q;
					$cookie = array(
		                'name'   => 'voucher',
		                'value'  => $code,
		                'expire' =>  86500,
		                'secure' => false
		            );
		            //print_r($product);
		            set_cookie($cookie); 
				} else {
					// voucher tidak ada
					$this->session->set_flashdata('notif', array('result' => 'voucher_na', 'msg' => 'Voucher not valid'));
					redirect('cart');
				}
			}			
		}

		$data['product'] = array();
		$data['photo'] = array();
		$data['qty'] = array();
		$data['variant'] = array();

		if(get_cookie('voucher') != null) {
			$q = $this->voucher_model->getVoucher(array('voucher_type' => 'global', 'exp_date >=' => date('Y-m-d') ),get_cookie('voucher'));

			if(count($q) >0 ) {
				// ada voucher
				$data['voucher'] = $q;
			}
		}

		if(unserialize(get_cookie('product')) != null) {
			$product = unserialize(get_cookie('product'));
			foreach ($product as $key => $value) {
				$cek = $this->product_model->getProduct(array('product.is_deleted' => 0), $value['id']);

				if(count($cek) > 0) {
					$data['product'][] = $cek;
					$data['qty'][] = $value['qty'];
					if($value['variant'] != '') {
						$data['variant'][] = $this->product_model->getVariant(null, null, $value['variant']); 
					} else {
						$data['variant'][] ='';
					}
					$cekimg = $this->product_model->getImageProduct(null, $value['id']);
					if(count($cekimg) > 0) {
						$data['photo'][] = $cekimg[0]->filename;
					} else {
						$data['photo'][] = '';
					}
				}
			}

			
		}

		$data['js'] = "
			/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

			$('.quantity-field__btn').on('click',function() {
				var id = $(this).attr('idx');
				var baseprice = $('#baseprice' + id).val();
				var qty = $('#qty' + id).val();

				if(qty <= 0) {
					qty = 1;
					$('#qty' + id).val(qty);
				}
				var t = qty * baseprice;
				$('#price' + id).html( formatRupiah(t, 'Rp. '));

				$.post('".base_url('cart/updatecart')."', { newid:id,newqty:qty }, function(data) {
					//alert(data);
					$('#totalidr').html(formatRupiah(data, 'Rp. '));
					location.reload();
				});
			});	

			$('.product-cart__item-remove-btn').on('click', function() {
				var idx = $(this).attr('idx');
				$.post('".base_url('cart/updatecart')."', { delaction:true, removeid:idx }, function(data) {
					
					$('#lst' + idx).fadeOut(300, function() { $(this).remove(); 
							if(data ==0) { location.reload(); }
						}); 
				});
			});
		";

		$this->load->view('v_header', $data);
		$this->load->view('v_cart',$data);
		$this->load->view('v_footer', $data);
	}

	public function checkout() {
		if(!$this->session->userdata('member')) {
			redirect('member/signin?b=cart');
		}

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Checkout';

		// curl raja ongkir untuk dapetin propinsi
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 6f27d98d6be9cdfd72518394b6131c2f"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// TODO: handle jika ada error di raja ongkir
			// redirect ke halaman error aja
		  echo "cURL Error #:" . $err;
		} else {
			$hasil = json_decode($response);
			if($hasil->rajaongkir->status->code == 200) {
				$data['propinsi'] = $hasil->rajaongkir->results;
				

			} else {
				// redirect ke halaman error aja
			}
		}


		// SUBMIT
		if($this->input->post('btnsubmit')) {
			print_r($_POST);
			die();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstname', 'Nama Depan', 'required');
			$this->form_validation->set_rules('lastname', 'Nama Belakang', 'required');
            $this->form_validation->set_rules('handphone', 'Handphone', 'required');
            $this->form_validation->set_rules('address', 'Alamat', 'required');
            $this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $data['warning'] = validation_errors();
            }
            else
            {
                die();
            }

		}

		$data['js'] = '
		$("#propinsi").on("change", function() {
			$("#kota").attr("disabled", true);
			$.post("'.base_url('cart/ajaxcity').'", {propid: $(this).val()}, function(data) {
				$("#kota").attr("disabled", false);
				var jsonobj = JSON.parse(data);
				if(jsonobj.rajaongkir.status.code == 200) {
					var result = jsonobj.rajaongkir.results;
					var str = "<option value=\'-\'>[Pilih Kota/Kabupaten]</option>";
					for(var i = 0; i < result.length; i++) {
						str += "<option value=\'" + result[i].city_id + "\'>" + result[i].city_name + "</option>";
					}
					$("#kota").html(str);

					
				}
			});
		});
		';

		$this->load->view('v_header', $data);
		$this->load->view('v_checkout',$data);
		$this->load->view('v_footer', $data);
	}

	public function ajaxcity() {
		$propid =  $this->input->post('propid');

		// curl untuk dapetin list kota dari propinsi tertentu
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$propid,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 6f27d98d6be9cdfd72518394b6131c2f"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		} else {
		  echo $response;
		}
	}

	public function updatecart() {
		//echo 'te'.$this->input->post('removeid');
		if($this->input->post('newid') !=  null) {

			$this->load->helper('cookie');
			$product = unserialize(get_cookie('product'));
			$product[$this->input->post('newid')]['qty'] = $this->input->post('newqty');
			$total = 0;
			foreach ($product as $key => $value) {
				// get base price
				$ceprice = $this->product_model->getProduct(null, $value['id']);
				if(count($ceprice) >0) {
					$total += $value['qty'] * $ceprice[0]->price;
				}
			}
			
			$cookie = array(
	                'name'   => 'product',
	                'value'  => serialize($product),
	                'expire' =>  86500,
	                'secure' => false
	        );
	        set_cookie($cookie); 
	        echo $total;
		} else if($this->input->post('delaction')) {
			$this->load->helper('cookie');
			$product = unserialize(get_cookie('product'));

			unset($product[$this->input->post('removeid')]); // remove item at index 0
			$newproducts = array_values($product); // 'reindex' array
			//print_r($newproducts);

			$cookie = array(
	                'name'   => 'product',
	                'value'  => serialize($newproducts),
	                'expire' =>  86500,
	                'secure' => false
	        );
	        set_cookie($cookie); 

	        echo count($newproducts);
		} else {
			redirect('cart');
		}	
	}
	
}
