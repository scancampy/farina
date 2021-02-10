<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function login($username, $password) {
		$q = $this->db->get_where('admin', array('username' => $username));

		if($q->num_rows()> 0) {
			$rq = $q->row();
			if(password_verify($password, $rq->password)) {
				return $rq;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
?>