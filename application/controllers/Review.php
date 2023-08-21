<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {
	public function __construct() {
		parent::__construct();
        // set header CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header("Access-Control-Allow-Headers: *");
        header('Access-Control-Allow-Credentials: *');
        if ("OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {die();}
        // Construct the parent class
       
    }

    private function _check_token($token) {
    	$secret_key = "6LdODPMlAAAAAEfgDO4mxkdSwflCqLvstgrf2dTp";
	    // call curl to POST request 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secret_key, 'response' => $token)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$arrResponse = json_decode($response, true);

		if($arrResponse["success"] == '1' && $arrResponse["score"] >= 0.5) {
			return false;
		    // valid submission 
		    // go ahead and do necessary stuff 
		} else {
			return true;
		}
    }

	public function index()
	{
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }

        $user = $this->session->userdata('member');

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Product Review';
		$data['js'] = '';

		if(!empty($this->input->get('token'))) {
			if($this->_check_token($this->input->get('token'))) {
				$this->session->set_flashdata('error', 'You\'re likely a bot.');
				redirect('confirm');
			}
		}

		if(!empty($this->input->post('token'))) {
			if($this->_check_token($this->input->post('token'))) {
				$this->session->set_flashdata('error', 'You\'re likely a bot.');
				redirect('confirm');
			}
		}
		
		if($this->input->get('order_id')) {
			$id = $this->input->get('order_id');
			$data['id'] = $id;

			$data['order'] = $this->trans_model->getTrans($id);

			//print_r($data['order']);
			//die();
			

			if(empty($data['order']['trans'])) {
				redirect('notfound');
			} else if($data['order']['trans']->member_id != $user->id) {
				redirect('notfound');
			}
		}

		if($this->input->post('btnsubmit')) {
			// cek apakah sudah ada rating semua?
			//print_r($data['order']['detil']);
			$sudahrate = 0;
			foreach ($data['order']['detil'] as $key => $value) {
				if($this->input->post('rate_'.$value->id)) {
					$sudahrate++;
					$this->trans_model->reviewProduct($value->id, $this->input->post('rate_'.$value->id), $this->input->post('comment_'.$value->id));
				}
			}

			if($sudahrate == count($data['order']['detil'])) {
				$this->trans_model->updateIsReviewedTrans($data['id']);
				$this->session->set_flashdata('order_reviewed', 'success');
				
				redirect('member/myorderdetails/'.$data['id']);
			} 

//			echo count($data['order']['detil']);
//			echo '<br/>'.$sudahrate;

//			print_r($_POST);
//			die();	
		}

		if($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}

		if($this->session->flashdata('success')) {
			$data['success'] = $this->session->flashdata('success');
		}
		

		// recaptcha
		$data['js'] .= '
			$("#btnsubmit").on("click", function(e) {
				e.preventDefault();
				grecaptcha.ready(function() {
		          grecaptcha.execute("6LdODPMlAAAAANqZ8s-N-ozy2Gz9dOFmni_1fPOl", {action: "submit"}).then(function(token) {
		              // Add your logic to submit to your backend server here.
		          		console.log(token);
		          		$("#token").val(token);
		          		$("#formpayment").submit();
		          });
		        });
			}); 

			$("#btnsubmitconfirm").on("click", function(e) {
				e.preventDefault();
				grecaptcha.ready(function() {
		          grecaptcha.execute("6LdODPMlAAAAANqZ8s-N-ozy2Gz9dOFmni_1fPOl", {action: "submit"}).then(function(token) {
		              // Add your logic to submit to your backend server here.
		          		console.log(token);
		          		$("#token").val(token);
		          		$("#formpayment").submit();
		          });
		        });
			}); 
		';

		$this->load->view('v_header', $data);
		$this->load->view('v_review',$data);
		$this->load->view('v_footer', $data);
	}	
}