<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
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

				$lastid = $this->voucher_model->editVoucher($this->input->post('hiddenid'), $this->input->post('voucher_type'), $this->input->post('title'),$this->input->post('description'), $this->input->post('min_order'), $this->input->post('discount_percentage'), $this->input->post('discount_value'), $this->input->post('exp_date'));

				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
			} else {
				$lastid = $this->voucher_model->addVoucher($this->input->post('voucher_code'), $this->input->post('voucher_type'), $this->input->post('title'),$this->input->post('description'), $this->input->post('min_order'), $this->input->post('discount_percentage'), $this->input->post('discount_value'), $this->input->post('exp_date'));

				if($lastid == false) {
					$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Voucher code already exist!'));

					redirect('admin/voucher');
				} else {
					$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));
				}
			}

			if(!empty($_FILES['fotovoucher']['name'])){
			 	$config['upload_path']          = './img/voucher/';
                $config['allowed_types'] 		= 'jpg|jpeg|png|gif';
                $config['max_size']             = 10000;
                $config['encrypt_name'] 		= true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fotovoucher')) {
                	$uploadData = $this->upload->data();
                	$filename = $uploadData['file_name'];  
                	$this->voucher_model->editVoucherImg($lastid, $filename);                      
                }
			}

			redirect('admin/voucher');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Voucher";
		$data['voucher'] = $this->voucher_model->getVoucher(array('is_deleted' => 0));

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

		// date picker
		$data['js'] .= '
						//Date range picker
    					$("#expireddate").datetimepicker({
					        format: "YYYY-MM-DD"
					    });';

		// handle edit
		$data['js'] .= '
		$("#btnaddvoucher").on("click", function() {
			$("#hiddenid").val("");
			$("#voucher_code").val("");	
			$("#voucher_code").prop("disabled", false);	
			$("#voucher_type_global").prop("checked", true);	
			$("#title").val("");
			$("#min_order").val(0);
			$("#discount_percentage").val(0);
			$("#discount_value").val(0);
			$("#exp_date").val("");
			$("#divcurrentvoucher").hide();
			$(".textarea").summernote("code", "");
		});

		$("body").on("click",".voudedit", function() {
			var id = $(this).attr("vouid");

			$.post("'.base_url('admin/voucher/jsongetvoucher').'", { sentid: id}, function(data){ 
				
				var obj = JSON.parse(data);
				$("#voucher_code").val(obj.data[0].voucher_code);
				$("#voucher_code").prop("disabled", true);
				$("#hiddenid").val(obj.data[0].voucher_code);
				$("#voucher_type_" + obj.data[0].voucher_type).prop("checked", true);
				$("#title").val(obj.data[0].title);
				$("#min_order").val(obj.data[0].min_order);
				$("#discount_percentage").val(obj.data[0].discount_percentage);
				$("#discount_value").val(obj.data[0].discount_value);
				$("#exp_date").val(obj.data[0].exp_date);

				if(obj.data[0].filename != null) {
					$("#divcurrentvoucher").show();
					var img = "'.base_url('img/voucher/').'" + obj.data[0].filename;
					$("#divvoucherimage").html("<img src=" + img + " style=\"width:200px;\" />");
				} else {
					$("#divcurrentvoucher").hide();
				}
				
				$("#modalAddProduct").modal();
				$(".textarea").summernote("code", obj.data[0].description);
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_master_voucher', $data);
		$this->load->view('admin/v_footer', $data);	
	}

	public function delvoucher($id) {
		$this->voucher_model->delVoucher($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/voucher');
	}

	// JSON
	public function jsongetvoucher() {
		if($this->input->post('sentid')) {
			$q = $this->voucher_model->getVoucher(null, $this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

}
