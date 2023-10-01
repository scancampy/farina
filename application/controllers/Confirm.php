<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm extends CI_Controller {
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
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Payment Confirmation';
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
			$data['order'] = $this->trans_model->getTrans($id);
			

			if(empty($data['order']['trans'])) {
				$this->session->set_flashdata('error', 'Order ID is not valid. Please make sure it correct and then try again.');
				redirect('confirm');
			}
		}

		
		if($this->input->post('hiddenid')) {
			if ($_FILES['proof']['error'] == 4 || ($_FILES['proof']['size'] == 0 && $_FILES['proof']['error'] == 0))
			{
				//29013883112
				//die();
			    $this->session->set_flashdata('error', 'Please upload payment proof (bukti bayar).');
				redirect('confirm?order_id='.$this->input->get('order_id'));
			} else {
				// Set preference
	          $config['upload_path'] = './images/payment_proof'; 
	          $config['allowed_types'] = 'jpg|jpeg|png|gif';
	          $config['max_size'] = '10000'; // max_size in kb
	          $config['encrypt_name'] = true;
	 
	          //Load upload library
	          $this->load->library('upload',$config); 

	           // File upload
	          if($this->upload->do_upload('proof')){
	            // Get data about the file
	            $uploadData = $this->upload->data();
	            $filename = $uploadData['file_name'];
	            $this->trans_model->updatePaymentProof($this->input->post('hiddenid'), $filename, $this->input->post('trans_to'));
	            $this->session->set_flashdata('success', 'We have received your payment proof successfully. Our team will now process your payment and proceed with your order. We appreciate your business and look forward to serving you. If you have any further questions or concerns, feel free to reach out to our customer support.');
				redirect('confirm');
	           } else {
	           		$this->session->set_flashdata('error', 'Please upload payment proof (bukti bayar).');
					redirect('confirm?order_id='.$this->input->get('order_id'));
	           }
			}
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
		$this->load->view('v_confirm',$data);
		$this->load->view('v_footer', $data);
	}	
}