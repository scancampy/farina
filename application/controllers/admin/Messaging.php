<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging extends CI_Controller {
	public function __construct()
	 {
          parent::__construct();
          // Your own constructor code
          if(empty($this->session->userdata('user'))) {
          	redirect('admin/dashboard/login');
          }
	 }
	 
	public function index() {
	
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

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Messaging";
		$data['messages'] = $this->messaging_model->getMessage(null, array('is_deleted' => null), 'created', 'desc');

		// handle data table
		$data['js'] .= ' $("#tablearticle").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_messaging', $data);
		$this->load->view('admin/v_footer', $data);
	}

	public function edit($id) {
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

		$data['messages'] = $this->messaging_model->getMessage($id);
		$data['messagemembers'] = $this->messaging_model->getMessageMembers($id);
		$data['files'] = $this->messaging_model->getMessageFiles($id);
		if(empty($data['messages'])) {
			redirect('admin/dashboard/login');
		}

		$data['id'] = $id;
		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Edit Message";
		$data['members'] = $this->member_model->getMember(null, array('status' => 'active', 'is_deleted' => 0)); 

		// edit
		if($this->input->post('btnsubmit')) {
			$this->messaging_model->editMessage($id, $this->input->post('title'), $this->input->post('content'));

			$idmessage = $id;

			// Count total files
      		$countfiles = count($_FILES['filemessage']['name']);
      		$judulfile = $this->input->post('filetitle');
 
      		// Looping all files
      		for($i=0;$i<$countfiles;$i++){
      			 if(!empty($_FILES['filemessage']['name'][$i])){
			      			 	// Define new $_FILES array - $_FILES['file']
			          $_FILES['file']['name'] = $_FILES['filemessage']['name'][$i];
			          $_FILES['file']['type'] = $_FILES['filemessage']['type'][$i];
			          $_FILES['file']['tmp_name'] = $_FILES['filemessage']['tmp_name'][$i];
			          $_FILES['file']['error'] = $_FILES['filemessage']['error'][$i];
			          $_FILES['file']['size'] = $_FILES['filemessage']['size'][$i];


			          // Set preference
			          $config['upload_path'] = './files/'; 
			          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|ppt|pptx';
			          $config['max_size'] = '20000'; // max_size in kb
			          $config['encrypt_name'] = true;
			          $config['file_name'] = $_FILES['filemessage']['name'][$i];
			 
			          //Load upload library
			          $this->load->library('upload',$config); 

			           // File upload
			          if($this->upload->do_upload('file')){
			            // Get data about the file
			            $uploadData = $this->upload->data();
			            $filename = $uploadData['file_name'];
			            $this->messaging_model->addFilesMessage($idmessage, $filename, $judulfile[$i]);
			          }
      			 }
      		}


			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Message updated successfully!'));

			redirect('admin/messaging/edit/'.$idmessage);
		}
		
		// file input
		$data['js'] .= 'bsCustomFileInput.init();';

		// submit
		$data['js'] .= '
		$("#btnsubmit").on("click", function() {
			$("#cover-spin").show(0);
		});';

		// add files
		$data['js'] .= '
			$("#btnaddfiles").on("click", function() {
				//console.log("tes");
				var countfiles = $("#countfiles").val();
				countfiles++;
				$("#countfiles").val(countfiles);

				var str = "<div class=\"form-group\">" + 
              			    "<label for=\"filemessage" + countfiles + "\">File input #" + countfiles + "</label>" +
              			    "<div class=\"input-group\" style=\"margin-bottom:10px;\">" +
                 "<input type=\"text\" class=\"form-control\" id=\"filetitle" + countfiles + "\" name=\"filetitle[]\" placeholder=\"Tuliskan judul file\">" +
              "</div>" + 
              			    "<div class=\"input-group\">" +
                			  "<div class=\"custom-file\">" +
                  				"<input type=\"file\" class=\"custom-file-input\" name=\"filemessage[]\" id=\"filemessage" + countfiles + "\">" +
                  				"<label class=\"custom-file-label\" for=\"filemessage" + countfiles + "\">Choose file</label>" + 
                			  "</div>" +
              				"</div>"
            			   "</div>";

            	$("#divfile").append(str);
            	bsCustomFileInput.init();
			});
		';

		// del file
		$data['js'] .= '
		$("body").on("click", ".btndelfile", function() {
			var i = $(this).attr("fileid");

			$.post("'.base_url('admin/messaging/jsondelfile').'", { sentid:i }, function(data) {
				console.log(data);
				location.reload();
			});
			console.log("del" + i);
		});
		';

		// select2
  		$data['js'] .= '    
  			//Initialize Select2 Elements
  			$(".select2bs4").select2({	
  				theme: "bootstrap4"
  			});';

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

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_edit_message', $data);
		$this->load->view('admin/v_footer', $data);
	}


	public function new() {
	
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
		if($this->input->post('btnsubmit')) {
			$members = null;
			if($this->input->post('radiodelivered') == 'individual') {
				$members = $this->input->post('members');
			} else if($this->input->post('radiodelivered') == 'all') {
				$q = $this->member_model->getMember(null, array('status' => 'active', 'is_deleted' => 0)); 

				foreach ($q as $key => $value) {
					$members[]= $value->id;	
				}
			} else if($this->input->post('radiodelivered') == 'vip') {
				$q = $this->member_model->getMember(null, array('status' => 'active', 'is_deleted' => 0,'member_type' => 'VIP')); 

				foreach ($q as $key => $value) {
					$members[]= $value->id;	
				}
			} else if($this->input->post('radiodelivered') == 'regular') {
				$q = $this->member_model->getMember(null, array('status' => 'active', 'is_deleted' => 0,'member_type' => 'regular')); 

				foreach ($q as $key => $value) {
					$members[]= $value->id;	
				}
			}  	

			$idmessage = $this->messaging_model->addMessage($this->input->post('title'), $this->input->post('content'), $this->input->post('radiodelivered'), $members);

			// Count total files
      		$countfiles = count($_FILES['filemessage']['name']);
      		$judulfile = $this->input->post('filetitle');
 
      		// Looping all files
      		for($i=0;$i<$countfiles;$i++){
      			 if(!empty($_FILES['filemessage']['name'][$i])){
			      			 	// Define new $_FILES array - $_FILES['file']
			          $_FILES['file']['name'] = $_FILES['filemessage']['name'][$i];
			          $_FILES['file']['type'] = $_FILES['filemessage']['type'][$i];
			          $_FILES['file']['tmp_name'] = $_FILES['filemessage']['tmp_name'][$i];
			          $_FILES['file']['error'] = $_FILES['filemessage']['error'][$i];
			          $_FILES['file']['size'] = $_FILES['filemessage']['size'][$i];


			          // Set preference
			          $config['upload_path'] = './files/'; 
			          $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|ppt|pptx';
			          $config['max_size'] = '20000'; // max_size in kb
			          $config['encrypt_name'] = true;
			          $config['file_name'] = $_FILES['filemessage']['name'][$i];
			 
			          //Load upload library
			          $this->load->library('upload',$config); 

			           // File upload
			          if($this->upload->do_upload('file')){
			            // Get data about the file
			            $uploadData = $this->upload->data();
			            $filename = $uploadData['file_name'];
			            $this->messaging_model->addFilesMessage($idmessage, $filename, $judulfile[$i]);
			          }
      			 }
      		}

      		foreach ($members as $key => $value) {
      				// tes kirim email
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.farinafemme.com';
				$config['smtp_port'] = 25;
				$config['smtp_user'] = 'noreply@farinafemme.com';
				$config['smtp_pass'] = 'p;B%GCo[?UCN';
				$config['mailtype'] = 'html';

				$footermessage = '<br/><br/>Untuk melihat pesan lebih lengkap, anda dapat masuk area member di website <a href="https://farinafemme.com/member/signin">Farina Femme</a>';
				$this->email->initialize($config);

				$this->email->from('noreply@farinafemme.com', 'Farina Femme');
				$memberinfo = $this->member_model->getMember(null, array('id' => $value));
				$this->email->to($memberinfo[0]->email);

				$this->email->subject($this->input->post('title').' - Farina Femme');
				$this->email->message($this->input->post('content').$footermessage);
				$this->email->send();
      		}



			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Message composed successfully!'));

			redirect('admin/messaging');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Compose New Message";
		$data['members'] = $this->member_model->getMember(null, array('status' => 'active', 'is_deleted' => 0)); 
		
		// file input
		$data['js'] .= 'bsCustomFileInput.init();';

		// submit
		$data['js'] .= '
		$("#btnsubmit").on("click", function() {
			$("#cover-spin").show(0);
		});';


		// add files
		$data['js'] .= '
			$("#btnaddfiles").on("click", function() {
				//console.log("tes");
				var countfiles = $("#countfiles").val();
				countfiles++;
				$("#countfiles").val(countfiles);

				var str = "<div class=\"form-group\">" + 
              			    "<label for=\"filemessage" + countfiles + "\">File input #" + countfiles + "</label>" +
              			    "<div class=\"input-group\" style=\"margin-bottom:10px;\">" +
                 "<input type=\"text\" class=\"form-control\" id=\"filetitle" + countfiles + "\" name=\"filetitle[]\" placeholder=\"Tuliskan judul file\">" +
              "</div>" + 
              			    "<div class=\"input-group\">" +
                			  "<div class=\"custom-file\">" +
                  				"<input type=\"file\" class=\"custom-file-input\" name=\"filemessage[]\" id=\"filemessage" + countfiles + "\">" +
                  				"<label class=\"custom-file-label\" for=\"filemessage" + countfiles + "\">Choose file</label>" + 
                			  "</div>" +
              				"</div>"
            			   "</div>";

            	$("#divfile").append(str);
            	bsCustomFileInput.init();
			});
		';

		// spesific member
		$data['js'] .= '
			$("#tospesific").on("click", function() {
				$("#pickmemberdiv").show();
			});

			$("#toregular, #tovip, #toall").on("click", function() {
				$("#pickmemberdiv").hide();
			});
		';

		// select2
  		$data['js'] .= '    
  			//Initialize Select2 Elements
  			$(".select2bs4").select2({	
  				theme: "bootstrap4"
  			});';

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

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_new_message', $data);
		$this->load->view('admin/v_footer', $data);
	}


	public function delevent($id) {
		$this->event_model->delEvent($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/events');
	}

	// JSON
	public function jsongetmember() {
		if($this->input->post('sentid')) {
			$q = $this->member_model->getMember(null, array("id" => $this->input->post('sentid')));

			$parent = null;

			if($q[0]->parent_member_id != null) {
				$parent = $this->member_model->getMember(null, array("id" => $q[0]->parent_member_id));
			}
			
			echo json_encode(array('result' => 'success', 'data' => $q, 'parent' => $parent));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

	public function jsondelfile() {
		if($this->input->post('sentid')) {
			$q = $this->messaging_model->delFileMessage($this->input->post('sentid'));

			echo json_encode(array('result' => 'success'));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

}
