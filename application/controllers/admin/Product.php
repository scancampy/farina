<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function index()
	{
		redirect('admin/dashboard');
	}

	public function master() {
		$data = array();
		$data['js'] ='';

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
			}
		}

		// add & update
		if($this->input->post('btnSubmit')) {

			if($this->input->post('hiddenid')) {
				$lastid = $this->product_model->editProduct(
					$this->input->post('hiddenid'),
					$this->input->post('name'), 
					$this->input->post('in_stock'),
					$this->input->post('brand_id'), 
					$this->input->post('short_desc'),
					$this->input->post('description'), 
					$this->input->post('weight'),
					$this->input->post('product_unit_id'), 
					$this->input->post('price'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
			} else {
				$lastid = $this->product_model->addProduct(
					$this->input->post('name'), 
					$this->input->post('in_stock'),
					$this->input->post('brand_id'), 
					$this->input->post('short_desc'),
					$this->input->post('description'), 
					$this->input->post('weight'),
					$this->input->post('product_unit_id'), 
					$this->input->post('price'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));
			}
			

			// hanlde photo
			// Count total files
      		$countfiles = count($_FILES['fotoproduct']['name']);
 
      		// Looping all files
      		for($i=0;$i<$countfiles;$i++){
      			 if(!empty($_FILES['fotoproduct']['name'][$i])){
			      			 	// Define new $_FILES array - $_FILES['file']
			          $_FILES['file']['name'] = $_FILES['fotoproduct']['name'][$i];
			          $_FILES['file']['type'] = $_FILES['fotoproduct']['type'][$i];
			          $_FILES['file']['tmp_name'] = $_FILES['fotoproduct']['tmp_name'][$i];
			          $_FILES['file']['error'] = $_FILES['fotoproduct']['error'][$i];
			          $_FILES['file']['size'] = $_FILES['fotoproduct']['size'][$i];


			          // Set preference
			          $config['upload_path'] = './img/product/'; 
			          $config['allowed_types'] = 'jpg|jpeg|png|gif';
			          $config['max_size'] = '10000'; // max_size in kb
			          $config['encrypt_name'] = true;
			          $config['file_name'] = $_FILES['fotoproduct']['name'][$i];
			 
			          //Load upload library
			          $this->load->library('upload',$config); 

			           // File upload
			          if($this->upload->do_upload('file')){
			            // Get data about the file
			            $uploadData = $this->upload->data();
			            $filename = $uploadData['file_name'];
			            $this->product_model->addImageProduct($lastid, $filename);
			           }
      			 }
      		}

			redirect('admin/product/master');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Master Product";
		$data['unit'] = $this->product_model->getUnit();
		$data['brand'] = $this->product_model->getBrand(array('is_deleted' => 0));
		$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0));

		//summernote
		$data['js'] .= ' $(".textarea").summernote({
						  height: 200,
						  toolbar: [
							  ["style", ["style"]],
							  ["font", ["bold", "underline", "clear"]],
							  ["fontname", ["fontname"]],
							  ["size", ["fontsize"]],
							  ["color", ["color"]],
							  ["para", ["ul", "ol", "paragraph"]],
							  ["table", ["table"]],
							  ["insert", ["link", "picture", "video"]],
							  ["view", ["fullscreen", "codeview", "help"]],
							],
						  focus: true,
						  fontSizes: ["8", "9", "10", "11", "12", "14", "16", "18", "24", "36", "48" , "64", "82", "150"]
						});';



		// handle data table
		$data['js'] .= ' $("#tablebrand").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });';

		// handle add more photo
		$data['js'] .= '
			$("#btnAddPhoto").on("click",function() {
				var newPhoto = "<div class=\"input-group mt-1 \">" +
									"<div class=\"custom-file\">" +
					                  "<input type=\"file\" class=\"form-control\" id=\"fotoproduct\" name=\"fotoproduct[]\">" +					              
					                "</div>" +
					              "</div>";
				$("#containerFoto").append(newPhoto);
			});
		';

		// handle edit
		$data['js'] .= '
		$("#btnaddproduct").on("click", function() {
			$("#hiddenid").val("");
			$("#name").val("");			
			$("#hiddenid").val("");
			$("#brand_id").val("");
			$("#short_desc").val("");
			$("#product_unit_id").val("");
			$("#weight").val("");
			$("#price").val("");
			$("#in_stock").prop( "checked", false );
			$("#modalAddProduct").modal();
			$(".textarea").summernote("code", "");
			var newPhoto = "<div class=\"input-group \">" +
									"<div class=\"custom-file\">" +
					                  "<input type=\"file\" class=\"form-control\" id=\"fotoproduct\" name=\"fotoproduct[]\">" +					              
					                "</div>" +
					              "</div>";
			$("#containerFoto").html(newPhoto);
			$("#uploadedFoto").html("");
		});

		$(".prodedit").on("click", function() {
			var id = $(this).attr("prodid");

			$.post("'.base_url('admin/product/jsongetproduct').'", { sentid: id}, function(data){ 
				var obj = JSON.parse(data);
				$("#uploadedFoto").html("");
				for(var i=0; i< obj.datafoto.length; i++) {
					var filename = obj.datafoto[i].filename;
					$("#uploadedFoto").append("<div class=\"col-md-3 \"><img class=\"img-fluid rounded img-thumbnail \" style=\"object-fit: cover; height:200px;\" src=\"'.base_url('img/product/').'" + filename + "\"/></div>");
				}
				
				$("#name").val(obj.data[0].name);
				$("#hiddenid").val(obj.data[0].id);
				$("#brand_id").val(obj.data[0].brand_id);
				$("#short_desc").val(obj.data[0].short_desc);
				$("#product_unit_id").val(obj.data[0].product_unit_id);
				$("#weight").val(obj.data[0].weight);
				$("#price").val(obj.data[0].price);
				if(obj.data[0].in_stock == 1) {
					$("#in_stock").prop( "checked", true );
				} else {
					$("#in_stock").prop( "checked", false );
				}
				$("#modalAddProduct").modal();
				$(".textarea").summernote("code", obj.data[0].description);
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_master_product', $data);
		$this->load->view('admin/v_footer', $data);
	}

	public function brand() {
		$data = array();
		$data['js'] ='';

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
			}
		}

		// add & update data
		if($this->input->post('btnSubmit')) {

			if($this->input->post('hiddenid')) {
				$this->product_model->editBrand($this->input->post('hiddenid'), $this->input->post('name'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));

			} else {
				$this->product_model->addBrand($this->input->post('name'));	
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));

			}
			
			redirect('admin/product/brand');	
		}

		$data['brand'] = $this->product_model->getBrand(array('is_deleted' => 0));

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Master Brand";

		// handle edit
		$data['js'] .= '
		$("#btnaddbrand").on("click", function() {
			$("#hiddenid").val("");
			$("#name").val("");
		});

		$(".brandedit").on("click", function() {
			var id = $(this).attr("brandid");
			$.post("'.base_url('admin/product/jsongetbrand').'", { sentid: id}, function(data){ 
				var obj = JSON.parse(data);
				var name = obj.data[0].name;
				var id = obj.data[0].id;
				$("#name").val(name);
				$("#hiddenid").val(id);
				$("#modalAddBrand").modal();
			});			
		});';

		// handle data table
		$data['js'] .= ' $("#tablebrand").DataTable({
      "responsive": true,
      "autoWidth": false,
    });';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_brand', $data);
		$this->load->view('admin/v_footer', $data);
	}

	public function delbrand($id) {
		$this->product_model->delBrand($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/product/brand');
	}

	public function delproduct($id) {
		$this->product_model->delProduct($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/product/master');
	}

	// JSON
	public function jsongetbrand() {

		if($this->input->post('sentid')) {
			$q = $this->product_model->getBrand(null, $this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

	public function jsongetproduct() {
		if($this->input->post('sentid')) {
			$q = $this->product_model->getProduct(null, $this->input->post('sentid'));
			$f = $this->product_model->getImageProduct(null,  $this->input->post('sentid')); 
			echo json_encode(array('result' => 'success', 'data' => $q, 'datafoto' => $f));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

}
