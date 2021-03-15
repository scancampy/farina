<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function login($username, $password) {
		$q = $this->db->get_where('admin', array('username' => $username));

		if($q->num_rows()> 0) {
			$rq = $q->row();
			if(password_verify($password, $rq->password)) {
				//sukses
				$data = array(
				        'last_login' => date('Y-m-d H:i:s')
				);

				$this->db->where('username', $username);
				$this->db->update('admin', $data);
				return $rq;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getSetting() {
		$q = $this->db->get_where('setting', array('id' => 1));
		return $q->row();
	}

	public function getSlides($where =  null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('display_order', 'asc');
		if($id != null) {
			$q = $this->db->get_where('slider', array('id' => $id));
		} else {
			$q = $this->db->get('slider');
		}

		return $q->result();
	}

	public function addSlide($title, $short_desc, $url = null, $filename, $url_caption = null) {
		$q = $this->db->get_where('slider', array('is_deleted' => 0));
		$next = $q->num_rows() + 1;
		
		$data = array('title' => $title,
					  'short_desc' => $short_desc,
					  'url'		 => $url,
					  'filename'	 => $filename, 
					  'url_caption'	 => $url_caption,
					  'display_order' => $next);
		$this->db->insert('slider', $data);

		return $voucher_code;
	}

	public function editSlide($id,$title, $short_desc, $url = null, $filename=null, $url_caption = null) {		
		
		$data = array('title' => $title,
					  'short_desc' => $short_desc,
					  'url'		 => $url,
					  'url_caption'	 => $url_caption);
		if($filename != null) {
			$data['filename'] = $filename;
		}

		$this->db->where('id',$id);
		$this->db->update('slider',$data);
		return $id;
	}

	public function delSlide($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('slider', $data);
		return true;
	}

}
?>