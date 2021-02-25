<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {
	public function signup($first_name, $last_name, $password, $email) {
		$this->load->helper('string');
		$id = password_hash(time(), PASSWORD_DEFAULT);
		$refid = random_string('alnum', 5).time();

		$q = $this->db->get_where('member', array('email' => $email));

		if($q->num_rows() > 0) {
			return false;
		} else {
			$data = array('id' => $id,
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