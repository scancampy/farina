<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
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
			$this->member_model->editProfile($this->input->post('email'), $this->input->post('first_name'), $this->input->post('last_name'));
			$this->member_model->updateStatus($this->input->post('email'), $this->input->post('status'));
			$this->member_model->updateType($this->input->post('email'), $this->input->post('member_type'));


			$this->session->set_flashdata('notif', array('type' => 'success', 'msg' => 'Data updated successfully!'));

			redirect('admin/member');
		}

		$data['name'] = $this->session->userdata('user')->name;
		$data['title'] = "Member";
		$data['member'] = $this->member_model->getMember(null, array('is_deleted' => 0));

		// handle data table
		$data['js'] .= ' $("#tablearticle").DataTable({
		      "responsive": true,
		      "autoWidth": false,
		    });';

		
		// handle edit
		$data['js'] .= '

		$("body").on("click",".memberedit", function() {
			var id = $(this).attr("memberid");

			$("#containerMedia").html("");

			$.post("'.base_url('admin/member/jsongetmember').'", { sentid: id}, function(data){ 
				console.log(data);
				var obj = JSON.parse(data);
				
				$("#first_name").val(obj.data[0].first_name);
				$("#last_name").val(obj.data[0].last_name);
				$("#hiddenid").val(obj.data[0].id);
				$("#email").val(obj.data[0].email);
				$("#member_type").val(obj.data[0].member_type);
				$("#status").val(obj.data[0].status);
				if(obj.data[0].joined_date != "0000-00-00 00:00:00") {

					$("#joined_date").val(obj.data[0].joined_date.substring(0,4));
				} else {
					$("#joined_date").val("N/A");
				}
				if(obj.data[0].became_vip_date != "0000-00-00 00:00:00") {
					var d= obj.data[0].became_vip_date.substring(8,10) + "/" + obj.data[0].became_vip_date.substring(5,7) + "/" +obj.data[0].became_vip_date.substring(0,4);
					$("#became_vip_date").val(d);
				} else {
					$("#became_vip_date").val("N/A");
				}

				if(obj.parent != null) {
					$("#referral").val(obj.parent[0].email + " (" + obj.parent[0].first_name +" " +obj.parent[0].last_name + ") ");
				} else {
					$("#referral").val("N/A");
				}
				
				$("#modalEditMember").modal();
			});			
		});';

		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_member', $data);
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

}
