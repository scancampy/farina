<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Cart';

		if(!empty($this->session->userdata('member'))) {
			$data['member'] =  $this->session->userdata('member');
		}

		$this->load->helper('cookie');

		if($this->input->post('btnsubmit')) {
			//die();
			// cek dulu apakah variant ada stok
			if($this->input->post('hidvariantchosen') != '') {
				$var = $this->product_model->getVariantWithProduct(null, $this->input->post('hidprodid'), $this->input->post('hidvariantchosen')); 
				$prod = $this->product_model->getProduct(null, $this->input->post('hidprodid'));
				if(!$var[0]->stok) {
					$this->session->set_flashdata('variant_no_stock', true);
					redirect('product/detail/'.$this->input->post('hidprodid').'/'.url_title($prod[0]->name));
				}				
			}
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
		if($this->input->post('btnCancelVoucherOngkir')) {
			delete_cookie('voucherongkir');
			redirect('cart'); 
		}

		if($this->input->post('btnApply')) {
			$code =  $this->input->post('voucher_code');
			$user = $this->session->userdata('member');

			if(isset($user)) {
				// kalau user sudah login
				if($this->voucher_model->checkVouhcerUsed($user->id, $code)) {
					$q = $this->voucher_model->getVoucher(array('exp_date >=' => date('Y-m-d') ),$code);

					if(count($q) >0 ) {
						// cek jika private
						if($q[0]->voucher_type =='private') {
							$data['private_voucher_eligible'] = $this->voucher_model->checkPrivateVoucher($code, $user->id);
						}

						if($q[0]->voucher_type == 'ongkir') {
							// cek jika ongkir
							// ada voucher
							$data['voucherongkir'] = $q;
							$cookie = array(
				                'name'   => 'voucherongkir',
				                'value'  => $code,
				                'expire' =>  86500,
				                'secure' => false
				            );
				            //print_r($product);
				            set_cookie($cookie); 
						} else {				
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
				        }
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
				$q = $this->voucher_model->getVoucher(array('exp_date >=' => date('Y-m-d') ),$code);

				if(count($q) >0 ) {
					if($q[0]->voucher_type == 'global' || $q[0]->voucher_type == 'produk' || $q[0]->voucher_type == 'brand') {
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
			        	$this->session->set_flashdata('notif', array('result' => 'voucher_na', 'msg' => 'Voucher is not valid'));
						redirect('cart');
			        } 
				} else {
					// voucher tidak ada
					$this->session->set_flashdata('notif', array('result' => 'voucher_na', 'msg' => 'Voucher is not valid'));
					redirect('cart');
				}
			}			
		}

		$data['product'] = array();
		$data['photo'] = array();
		$data['qty'] = array();
		$data['variant'] = array();

		if(get_cookie('voucher') != null) {

			$q = $this->voucher_model->getVoucher(array( 'exp_date >=' => date('Y-m-d') ),get_cookie('voucher'));

			if(count($q) >0 ) {
				// ada voucher
				$data['voucher'] = $q;
			}
		}

		if(get_cookie('voucherongkir') != null) {

			$q = $this->voucher_model->getVoucher(array( 'exp_date >=' => date('Y-m-d') ),get_cookie('voucherongkir'));

			if(count($q) >0 ) {
				// ada voucher
				$data['voucherongkir'] = $q;
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
					location.reload(); 
							if(data ==0) { location.reload(); }
					}); 
				});
			});
		";

		// loading
		$data['js'] .= "
			$('.checkoutbtn').on('click', function() {
				$('.loading').show();
			});
		";
		
		$this->load->view('v_header', $data);
		$this->load->view('v_cart',$data);
		$this->load->view('v_footer', $data);
	}

	public function checkout() {
		$this->load->helper('cookie');
		if(!$this->session->userdata('member')) {
			redirect('member/signin?b=cart');
		} else if(unserialize(get_cookie('product')) == null) {
			redirect('cart');
		} else {
			$member =  $this->session->userdata('member');
		}

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Checkout';

		// curl raja ongkir untuk dapetin propinsi
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
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

		// load data if cookie exist maka load cookie. If not maka load default address
		if(unserialize(get_cookie('address')) != null) {
			$data['address'] = unserialize(get_cookie('address'));
		} else {
			$hasil = $this->member_model->loadDefaultAddress($member->id);

			if($hasil) {
				$data['address']['firstname'] = $hasil->firstname;
				$data['address']['lastname'] = $hasil->lastname;
				$data['address']['handphone'] = $hasil->handphone;
				$data['address']['propinsi'] = $hasil->propinsi;
				$data['address']['kota'] = $hasil->kota;
				$data['address']['kecamatan'] = $hasil->kecamatan;
				$data['address']['address'] = $hasil->address;
				$data['address']['kodepos'] = $hasil->kodepos;
				$data['address']['kecamatan'] = $hasil->kecamatan;
			}
		}

		if(!empty($data['address'])) {
			// curl untuk dapetin list kota dari propinsi tertentu
			$propid = $data['address']['propinsi'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			 CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=".$propid,
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
			  	$hasil = json_decode($response);
				if($hasil->rajaongkir->status->code == 200) {
					$data['kota'] = $hasil->rajaongkir->results;
				} else {
					// redirect ke halaman error aja
				}
			}

			$cityid =  $data['address']['kota'];

			// curl untuk dapetin list kota dari propinsi tertentu
			$curl = curl_init();
			curl_setopt_array($curl, array(
		      CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$cityid,
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
			  	$hasil = json_decode($response);
				if($hasil->rajaongkir->status->code == 200) {
					$data['kecamatan'] = $hasil->rajaongkir->results;
				} else {
					// redirect ke halaman error aja
				}
			}
		} 
		

		// SUBMIT
		if($this->input->post('btnsubmit')) {
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
            	if($this->input->post('propinsi') != '-' && $this->input->post('kota') != '-' && $this->input->post('kecamatan') != '-') {
	            	// simpan cookie

	                $addressInfo = array(
	                	'firstname'		=> $this->input->post('firstname'),
	                	'lastname'		=> $this->input->post('lastname'),
	                	'handphone'		=> $this->input->post('handphone'),
	                	'propinsi'		=> $this->input->post('propinsi'),
	                	'kota'			=> $this->input->post('kota'),
	                	'kecamatan'		=> $this->input->post('kecamatan'),
	                	'address'		=> $this->input->post('address'),
	                	'kodepos'		=> $this->input->post('kodepos'),
	                	'propinsi'		=> $this->input->post('propinsi')
	                );

	                $cookie = array(
		                'name'   => 'address',
		                'value'  => serialize($addressInfo),
		                'expire' =>  86500,
		                'secure' => false
		            );
		            //print_r($product);
		            set_cookie($cookie); 
		            if($this->input->post('simpandefault')) {
		            	$this->member_model->updateDefaultAddress($member->id, $addressInfo['firstname'], $addressInfo['lastname'], $addressInfo['kodepos'], $addressInfo['address'], $addressInfo['handphone'], $addressInfo['propinsi'], $addressInfo['kota'], $addressInfo['kecamatan']);
		            }

		            // redirect to shipping
		            redirect('cart/shipping');
            	} else {
            		$data['warning'] = 'Periksa kembali provinsi, kota, dan kecamatan pengiriman';
            	}
            }

		}

        // ubah propinsi
		$data['js'] = '
		$("#propinsi").on("change", function() {
			$("#kota").attr("disabled", true);
			var str = "<option value=\'-\'>[Pilih Kota/Kabupaten]</option>";
			$("#kota").html(str);		

			$("#kecamatan").attr("disabled", true);
			var str = "<option value=\'-\'>[Pilih kecamatan]</option>";
			$("#kecamatan").html(str);
		
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

		// ubah city
		$data['js'] .= '
		$("#kota").on("change", function() {
			$("#kecamatan").attr("disabled", true);
			var str = "<option value=\'-\'>[Pilih kecamatan]</option>";
			$("#kecamatan").html(str);

			$.post("'.base_url('cart/ajaxdistrict').'", {cityid: $(this).val()}, function(data) {
				$("#kecamatan").attr("disabled", false);
				var jsonobj = JSON.parse(data);
				if(jsonobj.rajaongkir.status.code == 200) {
					var result = jsonobj.rajaongkir.results;
					var str = "<option value=\'-\'>[Pilih kecamatan]</option>";
					for(var i = 0; i < result.length; i++) {
						str += "<option value=\'" + result[i].subdistrict_id + "\'>" + result[i].subdistrict_name + "</option>";
					}
					$("#kecamatan").html(str);

					
				}
			});
		});
		';

		// loading
		$data['js'] .= "
			$('#btnsubmit').on('click', function() {
				$('.loading').show();
			});
		";

		$this->load->view('v_header', $data);
		$this->load->view('v_checkout',$data);
		$this->load->view('v_footer', $data);
	}

	public function ajaxcity() {
		$propid =  $this->input->post('propid');

		// curl untuk dapetin list kota dari propinsi tertentu
		$curl = curl_init();
		curl_setopt_array($curl, array(
		 CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=".$propid,
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

	public function ajaxdistrict() {
		$cityid =  $this->input->post('cityid');

		// curl untuk dapetin list kota dari propinsi tertentu
		$curl = curl_init();
		curl_setopt_array($curl, array(
	      CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$cityid,
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

	public function myinvoice($orderid=null) {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Invoice #'.$orderid;


		$data['trans'] = $this->trans_model->getTrans($orderid);
		if(empty($data['trans'])) {
			redirect('cart');
		}

		$data['detil'] = $this->trans_model->getTransDetail($orderid);

		$this->load->view('v_invoice',$data);
	}

	public function orderconfirmed($orderid=null) {
		$this->load->helper('cookie');
		if(!$this->session->userdata('member')) {
			redirect('member/signin?b=cart');
		} else if($orderid==null) {
			redirect('cart');
		} else {
			$member =  $this->session->userdata('member');
		}

		
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Order Confirmed';



		$data['trans'] = $this->trans_model->getTrans($orderid);
		if(empty($data['trans'])) {
			redirect('cart');
		}

		
		
		$this->load->view('v_header', $data);
		$this->load->view('v_order_confirmed',$data);
		$this->load->view('v_footer', $data);
	}

	public function shipping() {
		$this->load->helper('cookie');

		$data = array();
		if(!$this->session->userdata('member')) {
			redirect('member/signin?b=cart');
		} else if(unserialize(get_cookie('product')) == null) {
			redirect('cart');
		} else if(unserialize(get_cookie('address')) == null) {
			redirect('cart');
		} else {
			$member =  $this->session->userdata('member');
			$data['member'] = $member;
		}

		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Shipping';

		if(get_cookie('voucher') != null) {

			$voucher = $this->voucher_model->getVoucher(array('exp_date >=' => date('Y-m-d')),get_cookie('voucher'));
			//print_r($voucher);
			if(count($voucher) > 0) {		
				if($this->voucher_model->checkVouhcerUsed($member->id, get_cookie('voucher'))) {
					$data['voucher'] = $voucher;

					$data['private_voucher_eligible'] = $this->voucher_model->checkPrivateVoucher($data['voucher'][0]->voucher_code, $data['member']->id);
			//		die();
				}
			}
		}

		if(get_cookie('voucherongkir') != null) {

			$voucherongkir = $this->voucher_model->getVoucher(array('exp_date >=' => date('Y-m-d')),get_cookie('voucherongkir'));
			//print_r($voucher);
			if(count($voucherongkir) > 0) {		
				if($this->voucher_model->checkVouhcerUsed($member->id, get_cookie('voucherongkir'))) {
					$data['voucherongkir'] = $voucherongkir;

					$data['private_voucher_eligible'] = $this->voucher_model->checkPrivateVoucher($data['voucherongkir'][0]->voucher_code, $data['member']->id);
			//		die();
				}
			}
		}


		
		$data['address'] = unserialize(get_cookie('address'));


		if($this->input->post('btnsubmit')) {

			$cityid =  $data['address']['kota'];

			// curl untuk dapetin list kota dari propinsi tertentu
			$curl = curl_init();
			curl_setopt_array($curl, array(
		      CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?id=".$data['address']['kecamatan']."&city=".$cityid,
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
			  	$hasil = json_decode($response);
				if($hasil->rajaongkir->status->code == 200) {
					$data['kecamatan'] = $hasil->rajaongkir->results;
				}
			}

			$product = unserialize(get_cookie('product'));
			$totalweight = 0;
			$data['product'] = array();
			foreach ($product as $key => $value) {
				$hasil = $this->product_model->getProduct('', $value['id']);
				$totalweight += ($hasil[0]->weight * $value['qty']);
				$data['product'][$key]['product'] = $hasil;
				$data['product'][$key]['weight'] = ($hasil[0]->weight * $value['qty']);
				$data['product'][$key]['qty'] = $value['qty'];
				$data['product'][$key]['variant'] = $this->product_model->getVariant('',$value['id'],$value['variant']);
				$data['product'][$key]['img'] = $this->product_model->getImageProduct('',$value['id']);
			}

			$ongkir = 0;
			$layananongkir = '';

			// SICEPAT
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "origin=".$data['setting']->kecamatan."&originType=subdistrict&destination=".
			$data['address']['kecamatan']."&destinationType=subdistrict&courier=sicepat&weight=".$totalweight,
			  CURLOPT_HTTPHEADER => array(
			    "content-type: application/x-www-form-urlencoded",
			    "key: 6f27d98d6be9cdfd72518394b6131c2f"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  //echo "cURL Error #:" . $err;
			} else {
			  $hasil = json_decode($response);
			  if($hasil->rajaongkir->status->code == 200) {
				$costs = $hasil->rajaongkir->results[0]->costs;

				foreach ($costs as $key => $value) {
					if($value->service == $this->input->post('radiokirim')) {
						//echo 'R'.$value->service;
						$ongkir = $value->cost[0]->value;
						$layananongkir = $hasil->rajaongkir->results[0]->name.' '.$value->service;
						//echo '<br/>'.$value->description.' '.$value->cost[0]->value;
					}
				}

			  }
			}

			if($ongkir ==0) {
				// JNT
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "origin=".$data['setting']->kecamatan."&originType=subdistrict&destination=".$data['kecamatan']->subdistrict_id."&destinationType=subdistrict&courier=jnt&weight=".$totalweight,
				  CURLOPT_HTTPHEADER => array(
				    "content-type: application/x-www-form-urlencoded",
				    "key: 6f27d98d6be9cdfd72518394b6131c2f"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  //echo "cURL Error #:" . $err;
				} else {
				  $hasil = json_decode($response);
				  if($hasil->rajaongkir->status->code == 200) {
					$costs = $hasil->rajaongkir->results[0]->costs;

					foreach ($costs as $key => $value) {
						if($value->service == $this->input->post('radiokirim')) {
							//echo 'R'.$value->service;
							$ongkir = $value->cost[0]->value;
							$layananongkir = $hasil->rajaongkir->results[0]->name.' '.$value->service;
							//echo '<br/>'.$value->description.' '.$value->cost[0]->value;
						}
					}
				  }
				}
			}

			

			if($ongkir > 0) {

				$diskon = 0;
				$diskonongkir = 0;
				$voucher_code = null;
				$voucher_ongkir_code = null;


				$product = unserialize(get_cookie('product'));
				$totalweight = 0;
				$totaltrans = 0;
				foreach ($product as $key => $value) {
					$hasil = $this->product_model->getProduct('', $value['id']);
					$totalweight += ($hasil[0]->weight * $value['qty']);
					$totaltrans += ($hasil[0]->price * $value['qty']);
				}

				// voucher
				if(!empty($data['voucher'])) {

					if($data['voucher'][0]->voucher_type == 'global') {
						if($totaltrans >= $data['voucher'][0]->min_order) {
							$voucher_code = $data['voucher'][0]->voucher_code;

							if($data['voucher'][0]->discount_value > 0) {
								$diskon = $data['voucher'][0]->discount_value;
							} else { 
								$diskon = $totaltrans * ($data['voucher'][0]->discount_percentage/100); 
							}
						}
					} else if($data['voucher'][0]->voucher_type == 'private') {
						$private_voucher_eligible = $this->voucher_model->checkPrivateVoucher($data['voucher'][0]->voucher_code, $data['member']->id);
						if($totaltrans >= $data['voucher'][0]->min_order && $private_voucher_eligible) {
							$voucher_code = $data['voucher'][0]->voucher_code;

							if($data['voucher'][0]->discount_value > 0) {
								$diskon = $data['voucher'][0]->discount_value;
							} else { 
								$diskon = $totaltrans * ($data['voucher'][0]->discount_percentage/100); 
							}
						}
					} else if($data['voucher'][0]->voucher_type == 'vip') {
						if($totaltrans >= $data['voucher'][0]->min_order && @$member->member_type == 'VIP') {
							$voucher_code = $data['voucher'][0]->voucher_code;

							if($data['voucher'][0]->discount_value > 0) {
								$diskon = $data['voucher'][0]->discount_value;
							} else { 
								$diskon = $totaltrans * ($data['voucher'][0]->discount_percentage/100); 
							}
						}
					} else if($data['voucher'][0]->voucher_type == 'produk') {
						$adaproduk = false;
						foreach ($data['product'] as $key => $value) {
							if($value['product'][0]->id == $data['voucher'][0]->product_id) {

								$voucher_code = $data['voucher'][0]->voucher_code;
								$harga = ($value['product'][0]->price * $value['qty']);
								if($data['voucher'][0]->min_order <= $harga) {  
									if($data['voucher'][0]->discount_value > 0) { 
										$diskon = $data['voucher'][0]->discount_value;
									} else {  
										$diskon = $harga * ($data['voucher'][0]->discount_percentage/100); 
									}
								}

								$adaproduk = true;
								break;
							}
						}
					} else if($data['voucher'][0]->voucher_type == 'brand') {
						$adaproduk = false;
						$totalbrand =0;
						foreach ($data['product'] as $key => $value) {
							if($value['product'][0]->brand_id == $data['voucher'][0]->brand_id) {
								$totalbrand += ($value['product'][0]->price * $value['qty']);
								$adaproduk = true;
							}
						}

						if($adaproduk) {
							if($data['voucher'][0]->min_order <= $totalbrand) { 

								$voucher_code = $data['voucher'][0]->voucher_code;
								if($data['voucher'][0]->discount_value > 0) { 
									$diskon = $data['voucher'][0]->discount_value;
								} else { 
									$diskon = $totalbrand * ($data['voucher'][0]->discount_percentage/100); 
								}
							}
						}
					}
				}

				// voucher ongkir
				if(!empty($data['voucherongkir'])) {

					if($data['voucherongkir'][0]->voucher_type == 'ongkir') {
						if($totaltrans >= $data['voucherongkir'][0]->min_order) {
							$voucher_ongkir_code = $data['voucherongkir'][0]->voucher_code;

							if($data['voucherongkir'][0]->discount_value > 0) {
								$diskonongkir = $data['voucherongkir'][0]->discount_value;
							} else { 
								$diskonongkir = $totaltrans * ($data['voucherongkir'][0]->discount_percentage/100);

							}

							if($diskonongkir > $ongkir) {
								$diskonongkir = $ongkir;
							}
						}
					}
				}
				

				// simpan transaksi
				$transid =hexdec( substr(sha1(strtotime(date('Y-m-d H:i:s'))), 0, 10) );
				$order_placed_date = date('Y-m-d H:i:s');
				$trans = array(
					'id'					=> $transid,
					'order_placed_date'		=> $order_placed_date,
					'member_id'				=> $member->id,
					'firstname_receiver'	=> $data['address']['firstname'],
					'lastname_receiver'		=> $data['address']['lastname'],
					'phone'					=> $data['address']['handphone'],
					'address'				=> $data['address']['address'],
					'kecamatan'				=> $data['kecamatan']->subdistrict_name,
					'kota'					=> $data['kecamatan']->city,
					'propinsi'				=> $data['kecamatan']->province,
					'kodepos'				=> $data['address']['kodepos'],
					'total_trans'			=> $totaltrans,
					'total_weight'			=> $totalweight,
					'shipping_cost'			=> $ongkir,
					'shipping_service'		=> $layananongkir,
					'status'				=> "order_placed",
					'discount'				=> $diskon,
					'voucher_code'			=> $voucher_code,
					'voucher_ongkir_code'	=> $voucher_ongkir_code,
					'discount_ongkir'		=> $diskonongkir

				);

				//print_r($trans);
				//die();

				$this->trans_model->insertTrans($trans);

				if($voucher_code != null) {
					$this->voucher_model->useVoucher($voucher_code,$member->id, $transid);
				}

				if($voucher_ongkir_code != null) {
					$this->voucher_model->useVoucher($voucher_ongkir_code,$member->id, $transid);
				}


				foreach ($product as $key => $value) {
					$hasil = $this->product_model->getProduct('', $value['id']);
				
					$detiltrans = array(
						'trans_id'				=> $transid,
						'product_id'			=> $value['id'],
						'qty'					=> $value['qty'],
						'variant_id'			=> $value['variant'],
						'harga'					=> $hasil[0]->price
					);	

					$this->trans_model->insertDetailTrans($detiltrans);
				}

				$data['detil'] = $this->trans_model->getTransDetail($transid);
				$strDetil ='<dl>';


				foreach ($data['detil'] as $key => $value) {
					
					$strDetil .= '<dt><strong>'.$value->name.'</strong></dt>';
					if($value->variantname != '') {
						$strDetil .= '<dd>Variant: '.$value->variantname.'</dd>';
					}
					$strDetil .= '<dd>Qty: '.$value->qty.'</dd>';			
					$strDetil .= '<dd>Price: Rp. '.number_format($value->harga,0,',','.').'</dd>';
				}
				$strDetil .= '</dl>';

				// tes kirim email
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.farinafemme.com';
				$config['smtp_port'] = 25;
				$config['smtp_user'] = 'noreply@farinafemme.com';
				$config['smtp_pass'] = 'p;B%GCo[?UCN';
				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from('noreply@farinafemme.com', 'Farina Femme');
				$this->email->to($member->email);

				$tot = $totaltrans + $ongkir - $diskon - $diskonongkir;

				$diskstr = '';
				if($diskon >0) {
					$diskstr = 'Discount: Rp. '.number_format($diskon,0,',','.').' (kode voucher '.$voucher_code.')<br/>';
				}

				$diskongkirstr = '';
				if($diskonongkir >0) {
					$diskongkirstr = 'Discount Ongkir: Rp. '.number_format($diskonongkir,0,',','.').' (kode voucher '.$voucher_ongkir_code.')<br/>';
				}

				$this->email->subject('Order Confirmation - Farina Femme');
				$this->email->message('Thank you for choosing Farina Femme for your recent purchase! We\'re excited to let you know that your order has been successfully placed. Here are the details of your purchase:<br/><br/>
					Order ID: <strong>'.$transid.'</strong><br/>
					Order Date: '.strftime("%d %B %Y", strtotime($order_placed_date)).'<br/>
					Shipping Address: '.$data['address']['address'].', '.$data['kecamatan']->subdistrict_name.', '.$data['kecamatan']->city.', '.$data['kecamatan']->province.'<br/>
					Recipient: '.$data['address']['firstname'].' '.$data['address']['lastname'].' (phone: '.$data['address']['handphone'].')<br/><br/>
					Item(s) Purchased:<br/>'.$strDetil.'<br/><br/>
					Subtotal: Rp. '.number_format($totaltrans,0,',','.').'<br/>'.$diskstr.'
					Shipping: Rp. '.number_format($ongkir,0,',','.').' ('.$layananongkir.')<br/>'.$diskongkirstr.'
					Order Total: <strong>Rp. '.number_format($tot,0,',','.').'</strong><br/><br/>
					Your order has been received by our team. As soon as we receive your payment, we will begin processing your order.<br/><br/>The total amount due for your order is <strong>Rp. '.number_format($tot,0,',','.').'</strong>. Please make payment at your earliest convenience using the following details: <br/><br/>
				    <strong>'.$data['setting']->bank1.'</strong><br/>
				    <strong>No. Rek: '.$data['setting']->no_akun_bank1.'</strong><br/>
				    <strong>A/N: '.$data['setting']->nama_akun_bank1.'</strong><br/><br/>

				    To ensure a smooth and timely processing of your order, we kindly request you to confirm your payment by providing a payment proof screenshot. Please visit this link to confirm your payment: <br/>
				    <a href="'.base_url('confirm?order_id='.$transid).'">'.base_url('confirm?order_id='.$transid).'</a>
					<br/><br/>
				    If you have any questions or require further assistance regarding the payment process or any other concerns, please do not hesitate to reach out to our customer support team. We are here to help and ensure a seamless shopping experience for you.<br/><br/>

		Thank you for choosing Farina Femme. We truly appreciate your business and look forward to fulfilling your order soon.<br/><br/>

		Best regards,<br/>
		Farina Femme
				    ');

				

				$this->email->send();
				
				// delete all cookies
				delete_cookie('product');
				delete_cookie('voucher');
				delete_cookie('voucherongkir');
				delete_cookie('address');

				redirect('cart/orderconfirmed/'.$transid);
			} else {
				// TODO: Redirect to error
			}

			//die();
		}


		$cityid =  $data['address']['kota'];

		// curl untuk dapetin list kota dari propinsi tertentu
		$curl = curl_init();
		curl_setopt_array($curl, array(
	      CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?id=".$data['address']['kecamatan']."&city=".$cityid,
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
		  	$hasil = json_decode($response);
			if($hasil->rajaongkir->status->code == 200) {
				$data['kecamatan'] = $hasil->rajaongkir->results;
				//print_r($data['kecamatan']);

				// ONGKIR
				// TODO: berat harus tercantum di cookie
				// hitung berat
				$product = unserialize(get_cookie('product'));
				$totalweight = 0;
				$data['product'] = array();
				foreach ($product as $key => $value) {
					$hasil = $this->product_model->getProduct('', $value['id']);
					$totalweight += ($hasil[0]->weight * $value['qty']);
					$data['product'][$key]['product'] = $hasil;
					$data['product'][$key]['weight'] = ($hasil[0]->weight * $value['qty']);
					$data['product'][$key]['qty'] = $value['qty'];
					$data['product'][$key]['variant'] = $this->product_model->getVariant('',$value['id'],$value['variant']);
					$data['product'][$key]['img'] = $this->product_model->getImageProduct('',$value['id']);
				}

				$data['totalweight'] = $totalweight;

				// SICEPAT
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "origin=".$data['setting']->kecamatan."&originType=subdistrict&destination=".$data['kecamatan']->subdistrict_id."&destinationType=subdistrict&courier=sicepat&weight=".$totalweight,
				  CURLOPT_HTTPHEADER => array(
				    "content-type: application/x-www-form-urlencoded",
				    "key: 6f27d98d6be9cdfd72518394b6131c2f"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  //echo "cURL Error #:" . $err;
				} else {
				  $hasil = json_decode($response);
				  if($hasil->rajaongkir->status->code == 200) {
					$data['sicepat'] = $hasil->rajaongkir->results;
				  }
				}


				// JNT
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "origin=".$data['setting']->kecamatan."&originType=subdistrict&destination=".$data['kecamatan']->subdistrict_id."&destinationType=subdistrict&courier=jnt&weight=".$totalweight,
				  CURLOPT_HTTPHEADER => array(
				    "content-type: application/x-www-form-urlencoded",
				    "key: 6f27d98d6be9cdfd72518394b6131c2f"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  //echo "cURL Error #:" . $err;
				} else {
				  $hasil = json_decode($response);
				  if($hasil->rajaongkir->status->code == 200) {
					$data['jnt'] = $hasil->rajaongkir->results;
				  }
				}
			} else {
				// redirect ke halaman error aja
			}
		}


		$data['js'] = '

		function numberWithCommas(x) {
    		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

		$(".radioongkir").on("click",function() {
			var subtotal = $("#hiddentotal").val();
			var shippingcost = $(this).attr("cost");
			var diskon = $("#hiddendiskon").val();
			var diskonongkir = $("#hiddendiskonongkir").val();
			//alert("change" + shippingcost + " " + diskonongkir);
			if(parseInt(shippingcost) < parseInt(diskonongkir)) {
				diskonongkir = shippingcost;
				$("#voucherongkirdisc").html("- Rp. " + diskonongkir);
			//	alert("tes");
			}
			var total = parseInt(subtotal) - parseInt(diskon) - parseInt(diskonongkir) + parseInt(shippingcost);

			$("#shippingcost").html("Rp. " + numberWithCommas($(this).attr("cost")));
			$("#totalcost").html("<strong>Rp. " + numberWithCommas(total) + "</strong>");
		});
		';


		$this->load->view('v_header', $data);
		$this->load->view('v_shipping',$data);
		$this->load->view('v_footer', $data);
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
