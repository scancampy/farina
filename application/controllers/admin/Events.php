<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
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

		// add & update
		if($this->input->post('btnSubmit')) {

			if($this->input->post('hiddenid')) {
				$lastid = $this->event_model->editEvent(
					$this->input->post('hiddenid'),
					$this->input->post('name'),  
					$this->input->post('short_desc'), 
					$this->input->post('content'), 
					$this->input->post('eventdate'), 
					$this->input->post('eventtime'), 					
					$this->input->post('icon'), 
					$this->input->post('need_registration'), 
					$this->input->post('host'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
			} else {
				$lastid = $this->event_model->addEvent(
					$this->input->post('name'),  
					$this->input->post('short_desc'), 
					$this->input->post('content'), 
					$this->input->post('eventdate'), 
					$this->input->post('eventtime'), 					
					$this->input->post('icon'), 
					$this->input->post('need_registration'), 
					$this->input->post('host'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));
			}
			

			// hanlde photo
			// Count total files
      		$countfiles = count($_FILES['photo']['name']);
 
      		// Looping all files
      		for($i=0;$i<$countfiles;$i++){
      			 if(!empty($_FILES['photo']['name'][$i])){
			      			 	// Define new $_FILES array - $_FILES['file']
			          $_FILES['file']['name'] = $_FILES['photo']['name'][$i];
			          $_FILES['file']['type'] = $_FILES['photo']['type'][$i];
			          $_FILES['file']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
			          $_FILES['file']['error'] = $_FILES['photo']['error'][$i];
			          $_FILES['file']['size'] = $_FILES['photo']['size'][$i];


			          // Set preference
			          $config['upload_path'] = './img/events/'; 
			          $config['allowed_types'] = 'jpg|jpeg|png|gif';
			          $config['max_size'] = '10000'; // max_size in kb
			          $config['encrypt_name'] = true;
			          $config['file_name'] = $_FILES['photo']['name'][$i];
			 
			          //Load upload library
			          $this->load->library('upload',$config); 

			           // File upload
			          if($this->upload->do_upload('file')){
			            // Get data about the file
			            $uploadData = $this->upload->data();
			            $filename = $uploadData['file_name'];
			            $this->event_model->addImageEvent($lastid, $filename);
			           }
      			 }
      		}

      		// count variant
      		$youtube = $this->input->post('youtube');
      		foreach ($youtube as $key => $value) {
      			if($value != '') {
	      			$this->event_model->addYoutube($lastid,$value);
	      		}
      		}

			redirect('admin/events');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Master Events";
		$data['events'] = $this->event_model->getEvent(array('is_deleted' => 0));

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

		// date picker & time picker
		$data['js'] .= '
						//Date range picker
    					$("#eventdate").datetimepicker({
					        format: "YYYY-MM-DD"
					    });

						//Timepicker
					    $("#timepicker").datetimepicker({
					      format:"HH:mm"
					    })
';



		// handle data table
		$data['js'] .= ' $("#tablearticle").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });';

		// handle add more photo
		$data['js'] .= '
			$("#btnAddMediaPhoto").on("click",function() {
				var newPhoto = "<div class=\"input-group mb-1\">" +
									"<div class=\"custom-file\">" +
					                  "<input type=\"file\" class=\"form-control\" id=\"photo\" name=\"photo[]\">" +					              
					                "</div>" +
					              "</div>";

					               
				$("#containerMedia").append(newPhoto);
			});
		';

		// handle add more youtube
		$data['js'] .= '
			$("#btnAddMediaYoutube").on("click",function() {
				var newPhoto = "<div class=\"form-group mb-1\">" +
									"<div class=\"custom-file\">" +
					                  "<input type=\"text\" class=\"form-control\" name=\"youtube[]\"  placeholder=\"Copy paste Youtube embed link here\">" +
					                "</div>" +
					              "</div>";
					               
				$("#containerMedia").append(newPhoto);
			});
		';
		// handle edit
		$data['js'] .= '
		$("#btnaddevent").on("click", function() {
			$("#name").val("");			
			$("#hiddenid").val("");
			$("#short_desc").val("");
			$("#host").val("");
			$("#icon").val("");

			$("#eventdate").val("");
			$(".datetimepicker-input").val("");
			$("#no_registration").prop("checked", true);
			$("#member_registration").prop("checked", false);
			
			$("#modalAddEvent").modal();
			$(".textarea").summernote("code", "");
			
			$("#mediaContainer").html("");
			$("#containerMedia").html("");
		});


		$("body").on("click",".eventedit", function() {
			var id = $(this).attr("eventid");

			$("#containerMedia").html("");

			$.post("'.base_url('admin/events/jsongetevent').'", { sentid: id}, function(data){ 
				
				var obj = JSON.parse(data);

				$("#mediaContainer").html("");
				for(var i=0; i< obj.datafoto.length; i++) {
					if(obj.datafoto[i].media_type == "photo") {
						var filename = obj.datafoto[i].filename;
					$("#mediaContainer").append("<div class=\"col-md-3 \"><img class=\"img-fluid rounded img-thumbnail \" style=\"object-fit: cover; height:200px;\" src=\"'.base_url('img/events/').'" + filename + "\"/></div>");
					} else {
$("#mediaContainer").append("<div class=\"col-md-3 \">" + obj.datafoto[i].youtube_link + "</div>");
					}					
				}
				
				$("#name").val(obj.data[0].name);
				$("#hiddenid").val(obj.data[0].id);
				$("#host").val(obj.data[0].host);
				$("#icon").val(obj.data[0].icon);
				$("#short_desc").val(obj.data[0].short_desc);
				
				if(obj.data[0].need_registration == 1) {
					$("#member_registration").prop( "checked", true );
				} else {
					$("#no_registration").prop( "checked", false );
				}
				var dt = obj.data[0].event_date
				$(".eventdate").val(dt.substring(0, 10));
				$(".eventtime").val(dt.substring(11, 16));
				
				$("#modalAddEvent").modal();
				$(".textarea").summernote("code", obj.data[0].content);
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_master_event', $data);
		$this->load->view('admin/v_footer', $data);
	}


	public function delevent($id) {
		$this->event_model->delEvent($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/events');
	}

	// JSON
	public function jsongetevent() {
		if($this->input->post('sentid')) {
			$q = $this->event_model->getEvent(null, $this->input->post('sentid'));
			$f = $this->event_model->getImageEvent(null,  $this->input->post('sentid')); 
			
			echo json_encode(array('result' => 'success', 'data' => $q, 'datafoto' => $f));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

}
