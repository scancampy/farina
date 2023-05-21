<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct()
	 {
          parent::__construct();
          // Your own constructor code
          if(empty($this->session->userdata('user'))) {
          	redirect('admin/dashboard/login');
          }
	 }
	 
	public function slidesdown($id) {
		if($this->admin_model->editSlideDown($id)) {
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Slide display order have been adjusted!'));

			redirect('admin/setting/slides');
		} else {
			$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Unable to adjust slides display order!'));

			redirect('admin/setting/slides');
		}
	}

	public function slidesup($id) {
		if($this->admin_model->editSlideUp($id)) {
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Slide display order have been adjusted!'));

			redirect('admin/setting/slides');
		} else {
			$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Unable to adjust slides display order!'));

			redirect('admin/setting/slides');
		}
	}

	public function info() {
		// Tendang jika tidak ada session
		if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}
		$data = array();
		$data['js'] = '';
		

		// notif
		if($this->session->flashdata('notif')) {
			$notif = $this->session->flashdata('notif');
			if($notif['type'] == 'success') {
				$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });
				    Toast.fire({
				        icon: "success",
				        title: "'.$notif['msg'].'"
				      });';
			} else {
				if($notif['type'] == 'failed') {
				$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });
				    Toast.fire({
				        icon: "error",
				        title: "'.$notif['msg'].'"
				      });';
			}
			}
		}

		if($this->input->post('btnSubmit')) {
			$this->info_model->updateInfo($this->input->post('hiddenid'), $this->input->post('title'), $this->input->post('content'));
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Web Info successfully updated!'));

			redirect('admin/setting/info');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Info";
		$data['info'] = $this->info_model->getInfoAll();


		$data['js'] .= '
			$("body").on("click",".infoedit", function() {
			var id = $(this).attr("infoid");

			$.post("'.base_url('admin/setting/jsongetinfo').'", { sentid: id}, function(data){ 
				
				var obj = JSON.parse(data);
				console.log(obj.data);
				$("#title").val(obj.data.title);
				$("#hiddenid").val(obj.data.id);
				
				$("#modalEditInfo").modal();
				$(".textarea").summernote("code", obj.data.content);
			});			
		});';	
		
		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_web_info', $data);
		$this->load->view('admin/v_footer', $data);	
	}

	public function web() {
		// Tendang jika tidak ada session
		if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}

		$data = array();
		$data['js'] = '';
		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Web";

		// Handle Submit
		if($this->input->post('btnSubmit')) {
			if($this->input->post('propinsi') != '-' && $this->input->post('kota') != '-' && $this->input->post('kecamatan') != '-') {
				$this->admin_model->updateAddress($this->input->post('kodepos'), $this->input->post('alamat'), $this->input->post('propinsi'), $this->input->post('kota'), $this->input->post('kecamatan'));

				$this->admin_model->updateBank($this->input->post('bank1'), $this->input->post('bank2'), $this->input->post('no_akun_bank1'), $this->input->post('no_akun_bank2'), $this->input->post('nama_akun_bank1'), $this->input->post('nama_akun_bank2'));

				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Setting berhasil disimpan'));
			} else {
				$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Lengkapi data terlebih dahulu!'));
			}
		}

		// Ambil data setting
		$hasil = $this->admin_model->getSetting();

		if($hasil) {
			$data['address']['propinsi'] = $hasil->propinsi;
			$data['address']['kota'] = $hasil->kota;
			$data['address']['kecamatan'] = $hasil->kecamatan;
			$data['address']['address'] = $hasil->address;
			$data['address']['kodepos'] = $hasil->kodepos;
			$data['address']['bank1'] = $hasil->bank1;
			$data['address']['bank2'] = $hasil->bank2;
			$data['address']['no_akun_bank1'] = $hasil->no_akun_bank1;
			$data['address']['no_akun_bank2'] = $hasil->no_akun_bank2;
			$data['address']['nama_akun_bank1'] = $hasil->nama_akun_bank1;
			$data['address']['nama_akun_bank2'] = $hasil->nama_akun_bank2;
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

		$data['js'] ='';

		// notif
		if($this->session->flashdata('notif')) {
			$notif = $this->session->flashdata('notif');
			if($notif['type'] == 'success') {
				$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });
				    Toast.fire({
				        icon: "success",
				        title: "'.$notif['msg'].'"
				      });';
			} else {
				if($notif['type'] == 'failed') {
				$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });
				    Toast.fire({
				        icon: "error",
				        title: "'.$notif['msg'].'"
				      });';
			}
			}
		}

		// ubah propinsi
		$data['js'] .= '
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
		


		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_web_setting', $data);
		$this->load->view('admin/v_footer', $data);	
	}

	public function slides() {
		$data = array();
		$data['js'] = '';

		if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}

		// notif
		if($this->session->flashdata('notif')) {
			$notif = $this->session->flashdata('notif');
			if($notif['type'] == 'success') {
				$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });
				    Toast.fire({
				        icon: "success",
				        title: "'.$notif['msg'].'"
				      });';
			} else {
				if($notif['type'] == 'failed') {
				$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });
				    Toast.fire({
				        icon: "error",
				        title: "'.$notif['msg'].'"
				      });';
			}
			}
		}

		// add & update
		if($this->input->post('btnSubmit')){ 
			
			if($this->input->post('hiddenid')) {
				$filename = null;
				if(!empty($_FILES['filename']['name'])){
				 	$config['upload_path']          = './img/slides/';
	                $config['allowed_types'] 		= 'jpg|jpeg|png|gif';
	                $config['max_size']             = 10000;
	                $config['encrypt_name'] 		= true;

	                $this->load->library('upload', $config);

	                if ($this->upload->do_upload('filename')) {
	                	$uploadData = $this->upload->data();
	                	$filename = $uploadData['file_name'];                     
	                }
				}

				$lastid = $this->admin_model->editSlide($this->input->post('hiddenid'), $this->input->post('title'), $this->input->post('short_desc'), $this->input->post('url'), $filename, $this->input->post('url_caption'));

				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
			} else {
				// handle image upload
				$filename = null;
				if(!empty($_FILES['filename']['name'])){
				 	$config['upload_path']          = './img/slides/';
	                $config['allowed_types'] 		= 'jpg|jpeg|png|gif';
	                $config['max_size']             = 10000;
	                $config['encrypt_name'] 		= true;

	                $this->load->library('upload', $config);

	                if ($this->upload->do_upload('filename')) {
	                	$uploadData = $this->upload->data();
	                	$filename = $uploadData['file_name'];                     
	                }
				}

				if($filename != null) {
					$lastid = $this->admin_model->addSlide($this->input->post('title'), $this->input->post('short_desc'), $this->input->post('url'), $filename, $this->input->post('url_caption'));
					$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));

				} else {
					$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Unable to upload slide image !'));

					
				}
				redirect('admin/setting/slides');
			}

			

			redirect('admin/setting/slides');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Slides";
		$data['slides'] = $this->admin_model->getSlides(array('is_deleted' => 0));

			// handle data table
		$data['js'] .= ' $("#tableslide").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });';


		// handle edit
		$data['js'] .= '
		$("#btnaddslide").on("click", function() {
			$("#hiddenid").val("");
			$("#title").val("");	
			$("#short_desc").val("");	
			$("#url").val("");	
			$("#filename").val("");	
			$("#url_caption").val("");	
			$("#currentimage").hide();
		});

		$("body").on("click",".slideedit", function() {
			var id = $(this).attr("slideid");

			$.post("'.base_url('admin/setting/jsongetslide').'", { sentid: id}, function(data){ 
				
				var obj = JSON.parse(data);
				$("#title").val(obj.data[0].title);
				$("#hiddenid").val(obj.data[0].id);
				$("#short_desc").val(obj.data[0].short_desc);
				$("#url").val(obj.data[0].url);
				$("#url_caption").val(obj.data[0].url_caption);

				if(obj.data[0].filename != null) {
					$("#currentimage").show();
					var img = "'.base_url('img/slides/').'" + obj.data[0].filename;
					$("#currentimage").html("<img src=" + img + " style=\"width:200px;\" />");
				} else {
					$("#currentimage").hide();
				}
				
				$("#modalAddSlide").modal();
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_master_slides', $data);
		$this->load->view('admin/v_footer', $data);	
	}

	public function index() {
		redirect('admin/dashboard');
	}

	public function delslide($id) {
		$this->admin_model->delSlide($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/setting/slides');
	}

	// JSON
	public function jsongetslide() {
		if($this->input->post('sentid')) {
			$q = $this->admin_model->getSlides(null, $this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

	public function jsongetinfo() {
		if($this->input->post('sentid')) {
			$q = $this->info_model->getInfo($this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
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

}
