<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {
	public function login($email, $password) {
		$q = $this->db->get_where('member', array('email' => $username, 'status' => 'active', 'is_deleted' => 0));

		if($q->num_rows()> 0) {
			$rq = $q->row();
			if(password_verify($password, $rq->password)) {
				//sukses
				$data = array(
				        'last_login' => date('Y-m-d H:i:s')
				);

				$this->db->where('username', $username);
				$this->db->update('member', $data);
				return $rq;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function signup($first_name, $last_name, $password, $email, $parent_member_id=null) {
		$this->load->helper('string');
		$id = password_hash(time(), PASSWORD_DEFAULT);
		$refid = random_string('alnum', 5).time();

		$q = $this->db->get_where('member', array('email' => $email));

		if($q->num_rows() > 0) {
			return false;
		} else {

			if($parent_member_id != null) {
				$q = $this->db->get_where('member', array('ref_code'=> $parent_member_id));
				if($q->num_rows() > 0) {
					$hq = $q->row();
					$parent_member_id =$hq->id;
				} else {
					$parent_member_id = null;
				}
			}

			$data = array('id' => $id,
						  'parent_member_id' => $parent_member_id,
						  'first_name' => $first_name,
						  'last_name' => $last_name,
						  'email' => $email,
						  'password' => password_hash($password, PASSWORD_DEFAULT),
						  'ref_code' => $refid,
						  'status' => 'pending'
						 );
			$this->db->insert('member', $data);

			return true;
		}
		
	}

}
?>