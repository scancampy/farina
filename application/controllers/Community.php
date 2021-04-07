<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Community extends CI_Controller {
	public function index() {
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['selectedcatid'] = 'all';

		$data['photo'] = array();

		/*foreach ($data['article'] as $key => $value) {
			$data['photo'][] = $this->article_model->getImageArticle(null, $value->id);
		}*/


		$data['title'] = 'Community';
		$data['slides'] = $this->admin_model->getSlides(array('is_deleted' => 0));
		$offset = 0;
		$data['category'] = $this->article_model->getCategory(array('is_deleted' => 0));
		$data['post'] = $this->feed_model->getPost(null, null, 10, $offset); 
		$user = $this->session->userdata('member');

		$data['photo'] = array();
		$data['likes'] = array();
		foreach ($data['post'] as $key => $value) {
			$data['photo'][] = $this->feed_model->getImagePost(null, $value->id);
			$data['likes'][] = $this->feed_model->checkLike($value->id, $user->id);
		}

		if($this->session->flashdata('notif')) {
			$notif = $this->session->flashdata('notif');
			if($notif['type'] == 'success') {
				$data['js'] = ' alertify.success("'.$notif['msg'].'");';
			}
		}

		$data['js'] = '$("body").on("click", ".likesbutton", function() {
			alert("i like" + $(this).attr("likeid"));
		});';
		

		$this->load->view('v_header', $data);
		$this->load->view('v_community',$data);
		$this->load->view('v_footer', $data);
	}

	public function newpost() {
		if(!$this->session->userdata('member')) {
			redirect('notfound');
		}


		$data = array();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('content', 'Post Content', 'required');

		if($this->input->post('btnsubmit')) {

			if ($this->form_validation->run() == FALSE){
                $data['error'] = validation_errors();
               
            } else {
                ///$this->load->view('formsuccess');
                // sanitasi dulu pake php filter
                $content =  htmlentities($this->input->post('content'), ENT_QUOTES, 'UTF-8');
                $content = $this->security->xss_clean($content);
                $user = $this->session->userdata('member');
                $lastid = $this->feed_model->addPost($user->id, $content);

                // Count total files
	      		$countfiles = count($_FILES['image']['name']);
	 
	      		// Looping all files
	      		for($i=0;$i<$countfiles;$i++){
	      			if($i < 5) {
	      			 if(!empty($_FILES['image']['name'][$i])){
				      			 	// Define new $_FILES array - $_FILES['file']
				          $_FILES['file']['name'] = $_FILES['image']['name'][$i];
				          $_FILES['file']['type'] = $_FILES['image']['type'][$i];
				          $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				          $_FILES['file']['error'] = $_FILES['image']['error'][$i];
				          $_FILES['file']['size'] = $_FILES['image']['size'][$i];


				          // Set preference
				          $config['upload_path'] = './img/post/'; 
				          $config['allowed_types'] = 'jpg|jpeg|png|gif';
				          $config['max_size'] = '3000'; // max_size in kb
				          $config['encrypt_name'] = true;
				          $config['file_name'] = $_FILES['image']['name'][$i];
				 
				          //Load upload library
				          $this->load->library('upload',$config); 

				           // File upload
				          if($this->upload->do_upload('file')){
				            // Get data about the file
				            $uploadData = $this->upload->data();
				            $filename = $uploadData['file_name'];
				            $this->feed_model->addImagePost($lastid, $filename);
				          } 
	      			 }
	      			}
	      		}

                $this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'New post created'));
				redirect('community');
            }
		}

		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'New Post';

		$data['js'] = '
			var jumfoto = 1;
			$("#addmorephoto").on("click", function() {
				jumfoto++;
				if(jumfoto <= 5) {
					$("#templatephoto").clone().appendTo("#imagecontainer");
				} else {
					alert("Maksimal 5 foto yang dapat diunggah");
				}
				
			});
		';

		$this->load->view('v_header', $data);
		$this->load->view('v_new_post',$data);
		$this->load->view('v_footer', $data);
	}

	

}
