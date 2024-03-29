<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	 {
          parent::__construct();
          // Your own constructor code
          if(empty($this->session->userdata('user'))) {
          	redirect('admin/dashboard/login');
          }
	 }
	 

	public function index()
	{
		redirect('admin/dashboard');
	}

	private function _generateTree($array, $depth = 0, $selectedid = null) {
  	if(empty($array)) { return; }
  	$str = '';
  	foreach ($array as $key => $value) {
  		$labelName = '';
  		for($i = 0; $i < $depth; $i++) {
  			$labelName .= '-&nbsp;-&nbsp;';
  		}

  		$selstr = '';
  		if($selectedid != null) {
  			if($value->id == $selectedid) { $selstr = 'selected="selected"'; }
  		}
  		$str .= '<option value="'.$value->id.'" '.$selstr.'>'.$labelName.$value->name.'</option>';


  		if(!empty($value->child)) {
  			$newDepth = $depth+1;
  			$str.= $this->_generateTree($value->child, $newDepth, $selectedid);
  		}
  	}
  	return $str;
  }

  public function variant() {
  	$data = array();
  	$data['js'] = '';

  	if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}

		$data['title'] = "Manage Variant Stock";
		$data['variants'] = $this->product_model->getVariantWithProduct();
		$data['name'] = $this->session->userdata('user')->name;

		if($this->input->post('btnApply')) {
			$hiddenvariant = $this->input->post('hiddenidvariant');
			$stok  = $this->input->post('stok');
			$this->product_model->updateVariantStock($hiddenvariant,$stok);
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Variant stock succesfully updated'));
			redirect('admin/product/variant');
		}

		if($this->input->post('btnApplyBulk')) {
			$bulkchecks = $this->input->post('bulkqty');
			$bulkqty = $this->input->post('bulkstok');
			foreach ($bulkchecks as $key => $value) {
				$this->product_model->updateVariantStockById($value, $bulkqty);
			}
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Variant stock succesfully updated'));
			redirect('admin/product/variant');			
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

		// handle data table
		$data['js'] .= ' $("#tablebrand").DataTable({
      "responsive": true,
      "autoWidth": false,
    });';

    // handle check box
    $data['js'] .= '
    $("#checkall").change(function() {
        if(this.checked) {
            // Check all visible checkboxes in the current page
            $("table#tablebrand tbody tr:visible input[type=\'checkbox\']").prop("checked", true);
        } else {
            // Uncheck all checkboxes
            $("table#tablebrand tbody tr:visible input[type=\'checkbox\']").prop("checked", false);
        }
    });';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_manage_variant_stock', $data);
		$this->load->view('admin/v_footer', $data);
  }

  public function review() {
  	$data = array();
  	$data['js'] = '';

		if(!$this->session->userdata('user')) {
			redirect('admin/dashboard/login');
		}

		$data['title'] = "Manage Review";
		$data['products'] = $this->trans_model->getProductsNeedReview();
		$data['name'] = $this->session->userdata('user')->name;

		if($this->input->post('btnReject')) {
			$this->trans_model->rejectProductReview($this->input->post('hiddenid'));
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Review is succesfully rejected'));
			redirect('admin/product/review');
		}

		if($this->input->post('btnApprove')) {
			$this->trans_model->approveProductReview($this->input->post('hiddenid'));
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Review is successfully approved'));
			redirect('admin/product/review');
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

		$data['js'] .= '
		$("body").on("click", ".inspect", function() {
			var id = $(this).attr("transdetailid");
			$.post("'.base_url('admin/product/jsongetreview').'", { sentid: id}, function(data){ 
				var obj = JSON.parse(data);
				var name = obj.data[0].data.name;
				var brandname = obj.data[0].data.brandname;
				$("#name").val(name);
				$("#brand").val(brandname);
				$("#rating").val(obj.data[0].data.rating);
				$("#review").html(obj.data[0].data.review);
				$("#hiddenid").val(obj.data[0].data.id);
			});
		});
		';
		

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_manage_review', $data);
		$this->load->view('admin/v_footer', $data);
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
					$this->input->post('cbo_category'),
					$this->input->post('short_desc'),
					$this->input->post('description'), 
					$this->input->post('weight'),
					$this->input->post('product_unit_id'), 
					$this->input->post('price'),
					$this->input->post('price_het'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
			} else {
				$lastid = $this->product_model->addProduct(
					$this->input->post('name'), 
					$this->input->post('in_stock'),
					$this->input->post('brand_id'), 
					$this->input->post('cbo_category'),
					$this->input->post('short_desc'),
					$this->input->post('description'), 
					$this->input->post('weight'),
					$this->input->post('product_unit_id'), 
					$this->input->post('price'),
					$this->input->post('price_het'));
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

      		// count variant
      		$variants = $this->input->post('variant');
      		foreach ($variants as $key => $value) {
      			if($value != '') {
	      			$filename = "";
	      			if(!empty($_FILES['fotovariant']['name'][$key])){
				      			 	// Define new $_FILES array - $_FILES['file']
				          $_FILES['file']['name'] = $_FILES['fotovariant']['name'][$key];
				          $_FILES['file']['type'] = $_FILES['fotovariant']['type'][$key];
				          $_FILES['file']['tmp_name'] = $_FILES['fotovariant']['tmp_name'][$key];
				          $_FILES['file']['error'] = $_FILES['fotovariant']['error'][$key];
				          $_FILES['file']['size'] = $_FILES['fotovariant']['size'][$key];


				          // Set preference
				          $config['upload_path'] = './img/variant/'; 
				          $config['allowed_types'] = 'jpg|jpeg|png|gif';
				          $config['max_size'] = '10000'; // max_size in kb
				          $config['encrypt_name'] = true;
				          $config['file_name'] = $_FILES['fotovariant']['name'][$key];
				 
				          //Load upload library
				          $this->load->library('upload',$config); 
				          $this->upload->initialize($config);

				           // File upload
				          if($this->upload->do_upload('file')){
				            // Get data about the file
				            $uploadData = $this->upload->data();
				            $filename = $uploadData['file_name'];			         
				           } else {
				           	$error = array('error' => $this->upload->display_errors());

                      print_r($error); die();
				           }
	      			 }

	      			 $this->product_model->addVariant($lastid,$variants[$key], $filename);
      			}
      		}

      		$addurl = '';
      		if($this->input->get('brand_id_filter')) { $addurl = '?brand_id_filter='.$this->input->get('brand_id_filter'); }

			redirect('admin/product/master'.$addurl);
		}

		$data['tree'] = $this->category_model->getCategoryTree(null);
		$data['tree_html'] = $this->_generateTree($data['tree'],0);

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Master Product";
		$data['unit'] = $this->product_model->getUnit();
		$data['brand'] = $this->product_model->getBrand(array('is_deleted' => 0));

		$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0));
		if($this->input->get('brand_id_filter')) {
			if($this->input->get('brand_id_filter') != '-') {
				$data['product'] = $this->product_model->getProduct(array('product.is_deleted' => 0, 'brand_id' => $this->input->get('brand_id_filter')));
			} 
		}

		// select2
		$data['js'] .= '    
		//Initialize Select2 Elements
    $(".select2bs4").select2({
      theme: "bootstrap4"
    })
';

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

		// handle select brand
		$data['js'] .= '$("select#brand_id_filter").on("change", function() {
						$("#formcategory").submit();
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

		// handle add variant
		$data['js'] .= '
		$("#btnAddVariant").on("click", function() {
			var newVariant = "<div class=\"row mt-1\">" +
                "<div class=\"col-md-6\">" + 
                  "<div class=\"input-group\">" +
                    "<div class=\"custom-file\">" +
                      "<input type=\"file\" class=\"form-control\"  name=\"fotovariant[]\">" + 
                    "</div>" +
                  "</div>" +
                "</div>" +
                "<div class=\"col-md-6\">" +
                  "<input type=\"text\" class=\"form-control\" name=\"variant[]\"  placeholder=\"Write Variant Name here...\">" +
                "</div>" +
              "</div>";
             $("#containerVariant").append(newVariant);
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
			$("#price_het").val("");
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
			$("#containerVariant").html("");
			$("#variantContainer").html("");
			var newVariant = "<div class=\"row mt-1\">" +
                "<div class=\"col-md-6\">" + 
                  "<div class=\"input-group\">" +
                    "<div class=\"custom-file\">" +
                      "<input type=\"file\" class=\"form-control\"  name=\"fotovariant[]\">" + 
                    "</div>" +
                  "</div>" +
                "</div>" +
                "<div class=\"col-md-6\">" +
                  "<input type=\"text\" class=\"form-control\" name=\"variant[]\"  placeholder=\"Write Variant Name here...\">" +
                "</div>" +
              "</div>";
             $("#containerVariant").html(newVariant);
		});

		$("body").on("click",".btndelimg",function() {
			if(confirm(\'Yakin hapus gambar ini?\')) {
				var id = $(this).attr("delid");
				console.log(id);
				$(this).closest("div").remove();

				// del json 
				$.post("'.base_url('admin/product/jsondelimg').'", { sentid: id }, function(data) {
					
				});
			}
		});

		$("body").on("click",".btndelimgvariant",function() {
			if(confirm(\'Yakin hapus variant ini?\')) {
				var id = $(this).attr("delid");
				console.log(id);
				$(this).closest("div").remove();

				// del json 
				$.post("'.base_url('admin/product/jsondelvariant').'", { sentid: id }, function(data) {
					
				});
			}
		});

		function imgError(image) {
		    image.onerror = "";
		    image.src = "'.base_url('imgages/na.png').'";
		    return true;
		}

		$("body").on("click", ".prodedit", function() {
			var id = $(this).attr("prodid");

			$.post("'.base_url('admin/product/jsongetproduct').'", { sentid: id}, function(data){ 
				var obj = JSON.parse(data);
				$("#uploadedFoto").html("");
				for(var i=0; i< obj.datafoto.length; i++) {
					var filename = obj.datafoto[i].filename;
					console.log(obj.datafoto[i]);

					$("#uploadedFoto").append("<div class=\"col-md-3 \"><img class=\"img-fluid rounded img-thumbnail \" style=\"object-fit: cover; height:200px;\"   src=\"'.base_url('img/product/').'" + filename + "\"/><span class=\"btndelimg btn btn-warning\" delid=" + obj.datafoto[i].id + "  style=\"position: absolute; right: 10px; top: 5px;\"><i class=\"fa fa-trash\"></i></span></div>");
				}

				$("#variantContainer").html("");
				console.log(obj.datavariant);
				for(var i=0; i < obj.datavariant.length; i++) {
					var filename = obj.datavariant[i].filename;
					var image = new Image(); 
					var fileimage = "";
					console.log(filename);
					fileimage = "'.base_url('img/variant/').'" + filename;
					

					$("#variantContainer").append("<div class=\"col-md-3\">" + 
					"<img style=\"width:100%;\" src=\"" + fileimage + "\" />" + 
					"<input type=\"text\" class=\"form-control\" name=\"currentvariant[]\" value=\"" + obj.datavariant[i].name + "\" /><span class=\"btndelimgvariant btn btn-warning\" delid=" + obj.datavariant[i].id + "  style=\"position: absolute; right: 10px; top: 5px;\"><i class=\"fa fa-trash\"></i></span></div>");
				}

				// populate category
				$.post("'.base_url('admin/product/jsongetcategory').'", { catid: obj.data[0].category_id }, function(data) {
					$("#cbo_category").html(data);
					$(".select2bs4").select2({
			      theme: "bootstrap4"
			    });
				});
				
				$("#name").val(obj.data[0].name);
				$("#hiddenid").val(obj.data[0].id);
				$("#brand_id").val(obj.data[0].brand_id);
				$("#short_desc").val(obj.data[0].short_desc);
				$("#product_unit_id").val(obj.data[0].product_unit_id);
				$("#weight").val(obj.data[0].weight);
				$("#price").val(obj.data[0].price);
				$("#price_het").val(obj.data[0].price_het);
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
			} else {
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

		// add & update data
		if($this->input->post('btnSubmit')) {

			if($this->input->post('hiddenid')) {

				// gambar
				$config['upload_path']          = './images/brand/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 10024;
        $config['max_height']           = 7680;
        $config['file_ext_tolower'] 		= TRUE;
        $config['file_name']						= $this->input->post('hiddenid').'-'.url_title($this->input->post('name'),'-',TRUE).'.png';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
        	$this->product_model->editBrand($this->input->post('hiddenid'), $this->input->post('name'));
				  $this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
        }
        else
        {
        	$this->product_model->editBrand($this->input->post('hiddenid'), $this->input->post('name'),  $config['file_name']);
				  $this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
        }

			} else {
				// get latest increment
				$nextid= $this->product_model->getBrandNextId();
				
				// gambar
				$config['upload_path']          = './images/brand/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 10024;
        $config['max_height']           = 7680;
        $config['file_ext_tolower'] 		= TRUE;
        $config['file_name']						= $nextid.'-'.url_title($this->input->post('name'),'-',TRUE).'.png';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
        	$this->session->set_flashdata('notif', array('type' => 'error', 'msg' => 'Upload logo failed: '.$this->upload->display_errors()));

			
					redirect('admin/product/brand');	
        }
        else
        {
        	$this->product_model->addBrand($this->input->post('name'), $config['file_name']);	
				  $this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));
        }
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
	public function jsondelimg() {
		if($this->input->post('sentid')) {
			$q = $this->product_model->delImageProduct($this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

	public function jsondelvariant() {
		if($this->input->post('sentid')) {
			$q = $this->product_model->delVariant($this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}


	public function jsongetreview() {
		if($this->input->post('sentid')) {
			$q = $this->trans_model->getProductsNeedReview($this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

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
			$v = $this->product_model->getVariant(array('is_deleted' => 0),$this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q, 'datafoto' => $f, 'datavariant' => $v));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

	public function jsongetcategory() {
		$tree = $this->category_model->getCategoryTree(null);
		$tree_html = $this->_generateTree($tree,0, $this->input->post('catid'));
		echo $tree_html;
	}

}
