<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function index()
	{
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }
        $user = $this->session->userdata('member');

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Member Dashboard';
		$data['orders'] = $this->trans_model->getTransWhere('trans.member_id = "'.$user->id.'" AND trans.is_cancelled IS NULL AND trans.status != "order_delivered"');
		$data['vouchers'] = $this->voucher_model->getMemberVoucher($user->id);
		//$data['messages'] = $this->messaging_model->getMessage(null,"member_id='".$user->id."' AND ")
		//print_r($data['vouchers']);
		//echo 'trans.member_id = "'.$user->id.'" AND trans.is_cancelled = 0 AND trans.status != "order_delivered"';
		//print_r($data['orders']);

		$this->load->view('v_header', $data);
		$this->load->view('v_dashboard',$data);
		$this->load->view('v_footer', $data);
	}

	// Recover Password
	public function resetpassword($sha1 = null) {
		if(!empty($this->session->userdata('member'))) {
          	redirect('member');
        }

		$data = array();
		$data['js'] = '';
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Reset Password';
		$data['sha1'] = $sha1;

		if(!empty($this->input->post('token'))) {
			if($this->_check_token($this->input->post('token'))) {
				$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'You\'re likely a bot.'));

				redirect('member/resetpassword/'.$sha1);
			}
		}

		if($this->input->post('token')) {

			if($this->input->post('password') == $this->input->post('repeat_password')) {
				$this->member_model->resetPass($sha1, $this->input->post('password'));

				$this->session->set_flashdata('notif', array('result' => 'success', 'msg' => 'Your password has been successfully updated. You can now sign in to your account using your new password.'));

				redirect('member/signin');

			} else {
				$this->session->set_flashdata('notif', array('result' => 'failed', 'msg' => 'Pasword doesn\'t match'));

				redirect('member/resetpassword/'.$sha1);
			}
		}

		$result = $this->member_model->checkResetPassToken($sha1);

		if($result) {
			$data['result'] = $result;
		} else {	
			redirect('notfound');
		}

		// loading
		$data['js'] .= "
			$('#btnsubmit').on('click', function() {
				$('.loading').show();
			});
		";

		// recaptcha
		$data['js'] .= '
			$("#btnsubmit").on("click", function(e) {
				e.preventDefault();
				grecaptcha.ready(function() {
		          grecaptcha.execute("6LdODPMlAAAAANqZ8s-N-ozy2Gz9dOFmni_1fPOl", {action: "submit"}).then(function(token) {
		              // Add your logic to submit to your backend server here.
		          		console.log(token);
		          		$("#token").val(token);
		          		$("#formsignin").submit();
		          });
		        });
			}); 

		';

		$this->load->view('v_header', $data);
		$this->load->view('v_reset_password',$data);
		$this->load->view('v_footer', $data);
	}

	public function recover() {
		if(!empty($this->session->userdata('member'))) {
          	redirect('member');
        }

		$data = array();
		$data['js'] = '';
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Recover Password';

		if(!empty($this->input->post('token'))) {
			if($this->_check_token($this->input->post('token'))) {
				$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'You\'re likely a bot.'));

				redirect('member/recover');
			}
		}


		if($this->input->post('token')) {

			// cek email apakah ada di db
			$result  = $this->member_model->getMember($this->input->post('email'));

			if($result) {
				$sha1 = $this->member_model->triggerRecoverPass($this->input->post('email'));

				//print_r($result);
				//die();

				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.farinafemme.com';
				$config['smtp_port'] = 25;
				$config['smtp_user'] = 'noreply@farinafemme.com';
				$config['smtp_pass'] = 'p;B%GCo[?UCN';
				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from('noreply@farinafemme.com', 'Farina Femme');
				$this->email->to($this->input->post('email'));

				$this->email->subject('Recover Password - Farina Femme');
				$this->email->message('Dear '.$result[0]->first_name.' '.$result[0]->last_name.',<br/><br/>
Recently, a request was made to reset the password for your account. If you initiated this request, please follow the link below to reset your password:<br/><br/>

<a href="'.base_url('member/resetpassword/'.$sha1).'">'.base_url('member/resetpassword/'.$sha1).'</a><br/><br/>

If you did not request a password reset, please ignore this email. Your account security is important to us, and no changes will be made if you did not initiate this request.<br/><br/>

Thank you for choosing our online store.<br/><br/>


		Best regards,<br/>
		Farina Femme
				    ');

					$this->email->send();
	        		
	        		$this->session->set_flashdata('notif', array('result' => 'success', 'msg' => 'We\'ve received your request to reset your password. Please check your email inbox for instructions on how to complete the password reset process. If you don\'t see the email in your inbox, be sure to check your spam or junk folder. Follow the provided steps to securely reset your password and regain access to your account.'));
				redirect('member/recover');



			} else {
				// TODO: bikin notif error
				$this->session->set_flashdata('notif', array('result' => 'failed', 'msg' => 'We\'re sorry, but the email address you entered couldn\'t be found in our records. Please make sure you\'ve entered the correct email associated with your account'));
				redirect('member/recover');
			}
		}

		// loading
		$data['js'] .= "
			$('#btnsubmit').on('click', function() {
				$('.loading').show();
			});
		";

		// recaptcha
		$data['js'] .= '
			$("#btnsubmit").on("click", function(e) {
				e.preventDefault();
				grecaptcha.ready(function() {
		          grecaptcha.execute("6LdODPMlAAAAANqZ8s-N-ozy2Gz9dOFmni_1fPOl", {action: "submit"}).then(function(token) {
		              // Add your logic to submit to your backend server here.
		          		console.log(token);
		          		$("#token").val(token);
		          		$("#formsignin").submit();
		          });
		        });
			}); 

		';

		$this->load->view('v_header', $data);
		$this->load->view('v_recover',$data);
		$this->load->view('v_footer', $data);
	}

	// Voucher
	public function voucher() {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }
        $this->load->helper('text');


		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Voucher';
		$user = $this->session->userdata('member');

		$data['myvoucher'] = $this->voucher_model->getMemberVoucher($user->id);

		$data['js'] = "
		$('body').on('click','.buttoncopy', function() {
			var vc= $(this).attr('vouchercode');
			navigator.clipboard
		      .writeText(vc)
		      .then(() => {
		        alert('Voucher code is copied');
		      });

			
		});
		";


		$this->load->view('v_header', $data);
		$this->load->view('v_my_voucher',$data);
		$this->load->view('v_footer', $data);

	}
	// End of Voucher

	// Events
	public function myevents() {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }
        $this->load->helper('text');


		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Events';
		$user = $this->session->userdata('member');

		$data['myevents'] = $this->event_model->getMemberEvent($user->id);

		$this->load->view('v_header', $data);
		$this->load->view('v_my_events',$data);
		$this->load->view('v_footer', $data);

	}
	// End of Events


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

	public function signout() {
		$this->session->unset_userdata('member');
		redirect('member');
	}

	public function signin() {
		if(!empty($this->session->userdata('member'))) {
          	redirect('member');
        }

		$data = array();
		$data['js'] = '';
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Sign In';

		if(!empty($this->input->post('token'))) {
			if($this->_check_token($this->input->post('token'))) {
				$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'You\'re likely a bot.'));

				redirect('member/signin');
			}
		}


		if($this->input->post('token')) {

			$result = $this->member_model->login($this->input->post('email'), $this->input->post('password'));

			if($result) {
				if($result->status == 'pending') {
					$this->session->set_flashdata('notif', array('result' => 'failed', 'msg' => 'Your account is not active yet. Please check your email and follow the instructions to activated your account.'));
					redirect('member/signin');
				} else if($result->status == 'banned') {
					$this->session->set_flashdata('notif', array('result' => 'failed', 'msg' => 'We regret to inform you that your access to the member area has been temporarily suspended.'));
					redirect('member/signin');
				}

				$this->session->set_userdata('member', $result);
				// cek jika ada link back ke checkout

				if($this->input->get('b') == 'cart') {
					redirect('cart/checkout');
				}

				if($this->input->get('redirect') == 'event') {
					$idc = (int) $this->input->get('id');

					$data['event'] = $this->event_model->getEvent(array('is_deleted' => 0), $idc);

					if(!empty($data['event'])) {
						redirect('event/details/'.$idc.'/'.url_title($data['event'][0]->name));
					}
				}

				redirect('member');
			} else {
				// TODO: bikin notif error
				$this->session->set_flashdata('notif', array('result' => 'failed', 'msg' => 'Username or password is incorrect. Please try again.'));
				redirect('member/signin');
			}
		}

		// loading
		$data['js'] .= "
			$('#btnsubmit').on('click', function() {
				$('.loading').show();
			});
		";

		// recaptcha
		$data['js'] .= '
			$("#btnsubmit").on("click", function(e) {
				e.preventDefault();
				grecaptcha.ready(function() {
		          grecaptcha.execute("6LdODPMlAAAAANqZ8s-N-ozy2Gz9dOFmni_1fPOl", {action: "submit"}).then(function(token) {
		              // Add your logic to submit to your backend server here.
		          		console.log(token);
		          		$("#token").val(token);
		          		$("#formsignin").submit();
		          });
		        });
			}); 

		';

		$this->load->view('v_header', $data);
		$this->load->view('v_sign_in',$data);
		$this->load->view('v_footer', $data);
	}

	public function signup() {
		if(!empty($this->session->userdata('member'))) {
          	redirect('member');
        }

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Sign Up';
		$data['js'] = '';
		$data['terms'] = $this->info_model->getInfo(1);

		if(!empty($this->input->post('token'))) {
			if($this->_check_token($this->input->post('token'))) {
				$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'You\'re likely a bot.'));
				redirect('member/signup');
			}
		}

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('repeat_password', 'Repeat Pasword', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]');

        if ($this->form_validation->run() == FALSE)
        {
        	$data['error'] = validation_errors();
        } else {
        	if($this->input->post('email')) {
	        	if($this->input->post('check_aggreement')) {
	        		$sha1 = sha1(strtotime(date('Y-m-d H:i:s')).$this->input->post('email'));

	        		if($this->member_model->signup($this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('password'), $this->input->post('email'), $_GET['refcode'], $sha1)) {
	        			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Pendaftaran member sukses. Kami mengirimkan link kode aktivasi member ke email anda. Pastikan anda dapat mengakses link tersebut untuk mengaktifkan member anda.'));

	        			// tes kirim email
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.farinafemme.com';
				$config['smtp_port'] = 25;
				$config['smtp_user'] = 'noreply@farinafemme.com';
				$config['smtp_pass'] = 'p;B%GCo[?UCN';
				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from('noreply@farinafemme.com', 'Farina Femme');
				$this->email->to($this->input->post('email'));

				$this->email->subject('Account Activation - Farina Femme');
				$this->email->message('Dear '.$this->input->post('first_name').' '.$this->input->post('last_name').',<br/><br/>
Thank you for registering at our online store! We\'re thrilled to have you as a member of our community. Before you can start enjoying the amazing products and services we offer, we need you to activate your account.<br/><br/>

To ensure the security of your account, we require all users to go through a simple activation process. By activating your account, you will have full access to our website, exclusive deals, personalized recommendations, and much more!<br/><br/>

To activate your account, simply click on the following link:<br/>
<a href="'.base_url('activation?activationtoken='.$sha1).'">'.base_url('activation?activationtoken='.$sha1).'</a><br/><br/>

Rest assured that this link is secure and will take you to a dedicated activation page. If the link doesn\'t work, you can copy and paste the entire URL into your web browser\'s address bar.<br/><br/>

If you didn\'t register for an account on our website, please disregard this email. Your information may have been entered by mistake, and no further action is required.<br/><br/>

For any questions or concerns, please don\'t hesitate to reach out to our friendly customer support team at '.$data['setting']->email.'. We\'re here to help you through the activation process or with any other inquiries you may have.<br/><br/>

Thank you for choosing our online store. We can\'t wait to see you exploring the vast selection of products and enjoying a seamless shopping experience.<br/><br/>


		Best regards,<br/>
		Farina Femme
				    ');

					$this->email->send();
	        		} else {
	        			$this->session->set_flashdata('notif', array('type' => 'failed', 'msg' => 'Pendaftar member gagal dilakukan karena email telah terdaftar.'));
	        		}

	        		redirect('member/signup');
	        	} else {
	        		$data['error'] = '<li>Anda harus menyetujui syarat dan ketentuan</li>';
	        	}
	        }
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
		          		$("#formsignup").submit();
		          });
		        });
			}); 

		';

		$this->load->view('v_header', $data);
		$this->load->view('v_sign_up',$data);
		$this->load->view('v_footer', $data);
	}

	public function mypoints() {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Points';
		$user = $this->session->userdata('member');
		$data['poin'] = $this->trans_model->getPoin($user->id);

		$this->load->view('v_header', $data);
		$this->load->view('v_my_points',$data);
		$this->load->view('v_footer', $data);
	}

	public function myinbox() {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Inbox';
		$user = $this->session->userdata('member');
		$data['inbox'] = $this->messaging_model->getMemberMessage($user->id);

		//print_r($data['inbox']);
		//die();

		$this->load->view('v_header', $data);
		$this->load->view('v_my_inbox',$data);
		$this->load->view('v_footer', $data);
	}

	public function read($id) {
		// cek
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }
		$user = $this->session->userdata('member');
        $read = $this->messaging_model->readMessage($id, $user->id);

        if(!$read) {
        	redirect('notfound');
        }

        //print_r($read);
        //die();

        $data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Inbox';
		$data['inbox'] = $this->messaging_model->getMemberMessage($user->id);
		$data['files'] = $this->messaging_model->getMessageFiles($id);

		//print_r($data['inbox']);
		//die();

		$this->load->view('v_header', $data);
		$this->load->view('v_my_inbox_read',$data);
		$this->load->view('v_footer', $data);
	}

	public function myorders() {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Orders';
		$user = $this->session->userdata('member');

		$data['myorder'] = $this->trans_model->getTransWhere(array('member_id' => $user->id));
		


		$this->load->view('v_header', $data);
		$this->load->view('v_my_orders',$data);
		$this->load->view('v_footer', $data);

	}

	public function myorderdetails($id) {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'My Orders';
		$user = $this->session->userdata('member');

		$data['myorder'] = $this->trans_model->getTransWhere(array('trans.member_id' => $user->id, 'trans.id' => $id));

		if(empty($data['myorder'])) {
			redirect('notfound');
		}

		$data['myorderdetails'] = $this->trans_model->getTransDetail($id);
		
		$this->load->view('v_header', $data);
		$this->load->view('v_my_orders_details',$data);
		$this->load->view('v_footer', $data);	
	}

	public function profile() {
		if(empty($this->session->userdata('member'))) {
          	redirect('member/signin');
        }

		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$data['title'] = 'Profile';
		$user = $this->session->userdata('member');

		$data['profile'] = $this->member_model->getMember($user->email);	
		$hasil = $this->member_model->loadDefaultAddress($user->id);
		if($hasil) {
			$data['address']['firstname'] = $hasil->firstname;
			$data['address']['lastname'] = $hasil->lastname;
			$data['address']['handphone'] = $hasil->handphone;
			$data['address']['propinsi'] = $hasil->propinsi;
			$data['address']['kota'] = $hasil->kota;
			$data['address']['kecamatan'] = $hasil->kecamatan;
			$data['address']['address'] = $hasil->address;
			$data['address']['kodepos'] = $hasil->kodepos;
			$data['address']['kecamatan'] = $hasil->kecamatan;
		}

		if(!empty($data['address'])) {
			// curl untuk dapetin list kota dari propinsi tertentu
			$propid = $data['address']['propinsi'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			 CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=".$propid,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: 6f27d98d6be9cdfd72518394b6131c2f"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			} else {
			  	$hasil = json_decode($response);
				if($hasil->rajaongkir->status->code == 200) {
					$data['kota'] = $hasil->rajaongkir->results;
				} else {
					// redirect ke halaman error aja
				}
			}

			$cityid =  $data['address']['kota'];

			// curl untuk dapetin list kota dari propinsi tertentu
			$curl = curl_init();
			curl_setopt_array($curl, array(
		      CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$cityid,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: 6f27d98d6be9cdfd72518394b6131c2f"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			} else {
			  	$hasil = json_decode($response);
				if($hasil->rajaongkir->status->code == 200) {
					$data['kecamatan'] = $hasil->rajaongkir->results;
				} else {
					// redirect ke halaman error aja
				}
			}
		} 

		//print_r($data['address']);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|min_length[3]|max_length[100]');
		

        if ($this->form_validation->run() == FALSE)
        {
        	$data['error'] = validation_errors();
        } else {
			if($this->input->post('btnsubmit')) {
				$this->member_model->editProfile($user->email, $this->input->post('first_name'), $this->input->post('last_name'));

				if($this->input->post('propinsi') != '-' && $this->input->post('kota') != '-' && $this->input->post('kecamatan') != '-') {
	            	// simpan cookie

	                $addressInfo = array(
	                	'firstname'		=> $this->input->post('firstname'),
	                	'lastname'		=> $this->input->post('lastname'),
	                	'handphone'		=> $this->input->post('handphone'),
	                	'propinsi'		=> $this->input->post('propinsi'),
	                	'kota'			=> $this->input->post('kota'),
	                	'kecamatan'		=> $this->input->post('kecamatan'),
	                	'address'		=> $this->input->post('address'),
	                	'kodepos'		=> $this->input->post('kodepos'),
	                	'propinsi'		=> $this->input->post('propinsi')
	                );

	                $this->member_model->updateDefaultAddress($user->id, $addressInfo['firstname'], $addressInfo['lastname'], $addressInfo['kodepos'], $addressInfo['address'], $addressInfo['handphone'], $addressInfo['propinsi'], $addressInfo['kota'], $addressInfo['kecamatan']);
		            
            	} 


				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Profil berhasil diperbaharui.'));
				redirect('member/profile');
			} 
		}

		// curl raja ongkir untuk dapetin propinsi
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 6f27d98d6be9cdfd72518394b6131c2f"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// TODO: handle jika ada error di raja ongkir
			// redirect ke halaman error aja
		  echo "cURL Error #:" . $err;
		} else {
			$hasil = json_decode($response);
			if($hasil->rajaongkir->status->code == 200) {
				$data['propinsi'] = $hasil->rajaongkir->results; 

			} else {
				// redirect ke halaman error aja
			}
		}

		// ubah propinsi
		$data['js'] = '
		$("#propinsi").on("change", function() {
			$("#kota").attr("disabled", true);
			var str = "<option value=\'-\'>[Pilih Kota/Kabupaten]</option>";
			$("#kota").html(str);		

			$("#kecamatan").attr("disabled", true);
			var str = "<option value=\'-\'>[Pilih kecamatan]</option>";
			$("#kecamatan").html(str);
		
			$.post("'.base_url('cart/ajaxcity').'", {propid: $(this).val()}, function(data) {
				$("#kota").attr("disabled", false);
				var jsonobj = JSON.parse(data);
				if(jsonobj.rajaongkir.status.code == 200) {
					var result = jsonobj.rajaongkir.results;
					var str = "<option value=\'-\'>[Pilih Kota/Kabupaten]</option>";
					for(var i = 0; i < result.length; i++) {
						str += "<option value=\'" + result[i].city_id + "\'>" + result[i].city_name + "</option>";
					}
					$("#kota").html(str);

					
				}
			});
		});
		';

		// ubah city
		$data['js'] .= '
		$("#kota").on("change", function() {
			$("#kecamatan").attr("disabled", true);
			var str = "<option value=\'-\'>[Pilih kecamatan]</option>";
			$("#kecamatan").html(str);

			$.post("'.base_url('cart/ajaxdistrict').'", {cityid: $(this).val()}, function(data) {
				$("#kecamatan").attr("disabled", false);
				var jsonobj = JSON.parse(data);
				if(jsonobj.rajaongkir.status.code == 200) {
					var result = jsonobj.rajaongkir.results;
					var str = "<option value=\'-\'>[Pilih kecamatan]</option>";
					for(var i = 0; i < result.length; i++) {
						str += "<option value=\'" + result[i].subdistrict_id + "\'>" + result[i].subdistrict_name + "</option>";
					}
					$("#kecamatan").html(str);

					
				}
			});
		});
		';

		$this->load->view('v_header', $data);
		$this->load->view('v_profile',$data);
		$this->load->view('v_footer', $data);
	} 

	public function ajaxcity() {
		$propid =  $this->input->post('propid');

		// curl untuk dapetin list kota dari propinsi tertentu
		$curl = curl_init();
		curl_setopt_array($curl, array(
		 CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=".$propid,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 6f27d98d6be9cdfd72518394b6131c2f"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		} else {
		  echo $response;
		}
	}

	public function ajaxdistrict() {
		$cityid =  $this->input->post('cityid');

		// curl untuk dapetin list kota dari propinsi tertentu
		$curl = curl_init();
		curl_setopt_array($curl, array(
	      CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$cityid,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 6f27d98d6be9cdfd72518394b6131c2f"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		} else {
		  echo $response;
		}
	}
}
