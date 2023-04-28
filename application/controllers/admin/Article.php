<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
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
				$lastid = $this->article_model->editArticle(
					$this->input->post('hiddenid'),
					$this->input->post('title'),  
					$this->input->post('short_desc'), 
					$this->input->post('content'), 
					$this->input->post('is_published'), 
					$this->input->post('category_id'),
					$this->input->post('article_type'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));
			} else {
				$lastid = $this->article_model->addArticle(
					$this->input->post('title'),  
					$this->input->post('short_desc'), 
					$this->input->post('content'), 
					$this->input->post('is_published'), 
					$this->input->post('category_id'),
					$this->input->post('article_type'));
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
			          $config['upload_path'] = './img/article/'; 
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
			            $this->article_model->addImageArticle($lastid, $filename);
			           }
      			 }
      		}

      		// count variant
      		$youtube = $this->input->post('youtube');
      		foreach ($youtube as $key => $value) {
      			if($value != '') {
	      			$this->article_model->addYoutube($lastid,$value);
	      		}
      		}

			redirect('admin/article/master');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Master Article";
		$data['category'] = $this->article_model->getCategory(array('is_deleted' => 0));
		$data['article'] = $this->article_model->getArticle(array('article.is_deleted' => 0));

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
		$("#btnaddarticle").on("click", function() {
			$("#hiddenid").val("");
			$("#title").val("");			
			$("#hiddenid").val("");
			$("#category_id").val("");
			$("#short_desc").val("");
			$("#normal_type").prop("checked", true);
			$("#exclusive_type").prop("checked", false);
			
			$("#is_published").prop( "checked", false );
			$("#modalAddArticle").modal();
			$(".textarea").summernote("code", "");
			
			$("#uploadedFoto").html("");
			$("#containerMedia").html("");
		});

		$("body").on("click",".articleedit", function() {
			var id = $(this).attr("articleid");

			$("#containerMedia").html("");

			$.post("'.base_url('admin/article/jsongetarticle').'", { sentid: id}, function(data){ 
				
				var obj = JSON.parse(data);

				$("#mediaContainer").html("");
				for(var i=0; i< obj.datafoto.length; i++) {
					if(obj.datafoto[i].media_type == "photo") {
						var filename = obj.datafoto[i].filename;
					$("#mediaContainer").append("<div class=\"col-md-3 \"><img class=\"img-fluid rounded img-thumbnail \" style=\"object-fit: cover; height:200px;\" src=\"'.base_url('img/article/').'" + filename + "\"/></div>");
					} else {
$("#mediaContainer").append("<div class=\"col-md-3 \">" + obj.datafoto[i].youtube_link + "</div>");
					}					
				}
				
				$("#title").val(obj.data[0].title);
				$("#hiddenid").val(obj.data[0].id);
				$("#category_id").val(obj.data[0].category_id);
				$("#short_desc").val(obj.data[0].short_desc);
				
				if(obj.data[0].is_published == 1) {
					$("#is_published").prop( "checked", true );
				} else {
					$("#is_published").prop( "checked", false );
				}

				if(obj.data[0].article_type == "normal") {
					$("#normal_type").prop( "checked", true );
				} else {
					$("#exclusive_type").prop( "checked", true );
				}
				$("#modalAddArticle").modal();
				$(".textarea").summernote("code", obj.data[0].content);
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_master_article', $data);
		$this->load->view('admin/v_footer', $data);
	}

	public function category() {
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
				$this->article_model->editCategory($this->input->post('hiddenid'), $this->input->post('name'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));

			} else {
				$this->article_model->addCategory($this->input->post('name'));	
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data added successfully!'));

			}
			
			redirect('admin/article/category');	
		}

		$data['category'] = $this->article_model->getCategory(array('is_deleted' => 0));

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Master Article Category";

		// handle edit
		$data['js'] .= '
		$("#btnaddcategory").on("click", function() {
			$("#hiddenid").val("");
			$("#name").val("");
		});

		$("body").on("click",".categoryedit", function() {
			var id = $(this).attr("categoryid");
			$.post("'.base_url('admin/article/jsongetcategory').'", { sentid: id}, function(data){ 
				var obj = JSON.parse(data);
				var name = obj.data[0].name;
				var id = obj.data[0].id;
				$("#name").val(name);
				$("#hiddenid").val(id);
				$("#modalAddCategory").modal();
			});			
		});';

		// handle data table
		$data['js'] .= ' $("#tablecategory").DataTable({
      "responsive": true,
      "autoWidth": false,
    });';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_article_category', $data);
		$this->load->view('admin/v_footer', $data);
	}

	public function delcategory($id) {
		$this->article_model->delCategory($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/article/category');
	}

	public function delarticle($id) {
		$this->article_model->delArticle($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/article/master');
	}

	// JSON
	public function jsongetcategory() {

		if($this->input->post('sentid')) {
			$q = $this->article_model->getCategory(null, $this->input->post('sentid'));
			echo json_encode(array('result' => 'success', 'data' => $q));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

	public function jsongetarticle() {
		if($this->input->post('sentid')) {
			$q = $this->article_model->getArticle(null, $this->input->post('sentid'));
			$f = $this->article_model->getImageArticle(null,  $this->input->post('sentid')); 
			
			echo json_encode(array('result' => 'success', 'data' => $q, 'datafoto' => $f));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

}
