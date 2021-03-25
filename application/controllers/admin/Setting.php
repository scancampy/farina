<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
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

}
