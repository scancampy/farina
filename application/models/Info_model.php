<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_Model {
	public function getInfo($id) {
		$q = $this->db->get_where('info', array('id' => $id));
		return $q->row();
	}

	public function getInfoAll($where = null) {
		if($where != null) {
			$this->db->where($where);
		}

		$q = $this->db->get('info');
		return $q->result();
	}

	public function updateInfo($id, $title, $content) {
		$this->db->where('id', $id);
		$this->db->update('info', array('title' => $title, 'content' => $content));
	}
}
?>