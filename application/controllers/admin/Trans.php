<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans extends CI_Controller {
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
				$this->trans_model->updateTrans($this->input->post('hiddenid'), $this->input->post('noresi'), $this->input->post('radiostatus'));
				$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Transaction updated successfully!'));
			} 

			redirect('admin/trans');
		}

		// cancel
		if($this->input->post('btnCancelSubmit')) {
			$this->trans_model->cancelOrder($this->input->post('hiddenid'));
			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Transaction cancelled!'));

			// send email
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
			$q = $this->trans_model->getTrans($this->input->post('hiddenid'));
			$c = $this->member_model->getMember(null, array('id' => $q['trans']->member_id));
			$this->email->to($c[0]->email);

		
			$this->email->subject('Order Cancelled - Farina Femme');
			$this->email->message('We hope this message finds you well. We regret to inform you that your recent order #'.$this->input->post('hiddenid').' on our online shop has been cancelled. 
				<br/><br/>
				Should you wish to explore our wide range of products once again, we encourage you to visit our website at '.base_url().'. We constantly update our inventory with new and exciting items that may capture your interest.
				<br/><br/> 
			    We understand that customer satisfaction is of utmost importance, and we value your patronage. If you have any further inquiries or concerns regarding the cancellation, please don\'t hesitate to contact our customer support team.<br/><br/>

	Thank you for choosing Farina Femme. We truly appreciate your business and look forward to fulfilling your order soon.<br/><br/>

	Best regards,<br/>
	Farina Femme
			    ');

			

			$this->email->send();
			redirect('admin/trans');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Transactions";
		$data['trans'] = $this->trans_model->getTransWhere();
		$data['setting'] = $this->admin_model->getSetting();
		

		// handle data table
		$data['js'] .= ' $("#tablearticle").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });';

		
		// handle edit
		$data['js'] .= '
		function numberWithCommas(x) {
		    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

		$("body").on("click",".transedit", function() {
			var id = $(this).attr("transid");

			console.log(id);

			$.post("'.base_url('admin/trans/jsongettrans').'", { sentid: id}, function(data){ 
				
				var obj = JSON.parse(data);
				console.log(obj.data.trans);
				
				$("#hiddenid").val(obj.data.trans.id);
				$("#transid").val(obj.data.trans.id);
				var d= obj.data.trans.order_placed_date.substring(8,10) + "/" + obj.data.trans.order_placed_date.substring(5,7) + "/" +obj.data.trans.order_placed_date.substring(0,4);
				$("#order_placed_date").val(d + " " + obj.data.trans.order_placed_date.substring(11,20));

				$("#customer").val(obj.member[0].first_name + " " + obj.member[0].last_name + " (" + obj.member[0].email + ")");

				var tablestr = "";
				for(var i =0; i < obj.detil.length; i++) {
					var tot = (parseInt(obj.detil[i].price) *  parseInt(obj.detil[i].qty));
					tablestr += "<tr>";
					tablestr += "<td>" + obj.detil[i].name + "</td>";
					tablestr += "<td>" + obj.detil[i].qty + "</td>";
					tablestr += "<td>" + numberWithCommas(obj.detil[i].price) + "</td>";
					tablestr += "<td>" + numberWithCommas(tot) + "</td>";
					tablestr += "</tr>";
				}

				console.log(tablestr);

				$("#tbody_items").html(tablestr);
				$("#subtotal").html("Rp. " + numberWithCommas(obj.data.trans.total_trans));

				if(obj.data.trans.discount >0) {
					$("#discount_info").html("Discount (Voucher: " + obj.data.trans.voucher_code + ")");
					
					$("#discount").html("-Rp. " + numberWithCommas(obj.data.trans.discount));
				} else {
					$("#discount").html("Rp. 0");
				}

				$("#shippping").html("Rp. " + numberWithCommas(obj.data.trans.shipping_cost));

				var total = parseInt(obj.data.trans.total_trans) + parseInt(obj.data.trans.shipping_cost) - parseInt(obj.data.trans.discount);

				$("#total").html("<strong>Rp. " + numberWithCommas(total) + "</strong>");

				$("#recipient").val(obj.data.trans.firstname_receiver + " " + obj.data.trans.lastname_receiver );

				$("#phone").val(obj.data.trans.phone);

				$("#weight").val(parseInt(obj.data.trans.total_weight) / 1000);

				$("#address").val(obj.data.trans.address+ ", " + obj.data.trans.kecamatan + ", " + obj.data.trans.kota + ", " + obj.data.trans.propinsi + ", " + obj.data.trans.kodepos);

				$("#shipping_service").val(obj.data.trans.shipping_service);
				$("#noresi").val(obj.data.trans.no_resi);

				
				if(obj.data.trans.payment_confirmation_date != null) {
					var d= obj.data.trans.payment_confirmation_date.substring(8,10) + "/" + obj.data.trans.payment_confirmation_date.substring(5,7) + "/" +obj.data.trans.payment_confirmation_date.substring(0,4);
					$("#payment_confirmation_date").val(d + " " + obj.data.trans.payment_confirmation_date.substring(11,20));
				} else {
					$("#payment_confirmation_date").val("Not Available");
				}

				if(obj.data.trans.payment_to != null) {
					$("#payment_to").val($("#payment_to" + obj.data.trans.payment_to).val());
				} else {
					$("#payment_to").val("Not Available");
				}

				if(obj.data.trans.payment_proof_filename != null) {
					$("#proof_container").html("<a href=\'" + window.location.origin + "/images/payment_proof/" + obj.data.trans.payment_proof_filename +  "\' target=\'_blank\'><img src=\'" + window.location.origin + "/images/payment_proof/" + obj.data.trans.payment_proof_filename + "\' style=\'width:200px;\'/></a>");
				} else {
					$("#proof_container").html("<p>Not Available</p>");
				}


				if(obj.data.trans.status == "order_placed") {
					$("#radio_order_placed").prop("checked", true);
				} else if(obj.data.trans.status == "order_prepared") {
					$("#radio_order_prepared").prop("checked", true);
				} else if(obj.data.trans.status == "order_in_transit") {
					$("#radio_order_in_transit").prop("checked", true);
				} else if(obj.data.trans.status == "order_delivered") {
					$("#radio_order_delivered").prop("checked", true);
				}

				if(obj.data.trans.is_cancelled == 1) {
					$("#callout-cancelled").show();
					$("#radiostatus").hide();
					$("#btnCancelSubmit").hide();
					$("#btnSubmit").hide();
				} else {
					$("#callout-cancelled").hide();
					$("#radiostatus").show();
					$("#btnCancelSubmit").show();
					$("#btnSubmit").show();
				}
				
				$("#modalAddEvent").modal();
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_transactions', $data);
		$this->load->view('admin/v_footer', $data);
	}


	public function delevent($id) {
		$this->event_model->delEvent($id);
		$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data deleted successfully!'));

		redirect('admin/events');
	}

	// JSON
	public function jsongettrans() {
		if($this->input->post('sentid')) {
			$q = $this->trans_model->getTrans($this->input->post('sentid'));
			$f = $this->trans_model->getTransDetail($this->input->post('sentid')); 
			$c = $this->member_model->getMember(null, array('id' => $q['trans']->member_id));
			
			echo json_encode(array('result' => 'success', 'data' => $q, 'detil' => $f, 'member' => $c));
		} else {
			echo json_encode(array('result' => 'failed'));
		}
	}

}
