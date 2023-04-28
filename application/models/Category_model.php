<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
	public function addCategory($rootid=null, $name) {
		$this->load->helper('string');

		do {
			$randomID =  random_string('numeric', 4);
			$q = $this->db->get_where('category', array('id' => $randomID));
		} while($q->num_rows() > 1);

		$data = array('rootid' 			=> $rootid,
					  'id' 				=> $randomID, 
					  'name' 			=> $name
					);
		
		$this->db->insert('category',$data);
		return true;
	}

	public function getCategoryTree($rootid=null) {
		$array = array();
		$this->db->order_by('name','asc');
		$q =$this->db->get_where('category', array('rootid' => $rootid, 'is_deleted' => null));

		if($q->num_rows() == 0) {
			return null;
		}

		$resq = $q->result();

		foreach ($resq as $key => $value) {
			$value->child = $this->getCategoryTree($value->id);
			$array[] = $value; 
		}

		return $array;
	}

	public function getCategory($rootid) {
		$q =$this->db->get_where('category', array('rootid' => $rootid, 'is_deleted' => null));

		return $q->result();
	}

	public function getCategoryById($id) {
		$q = $this->db->get_where('category', array('id' => $id));
		return $q->result();
	}

	public function getRoot($id) {
		$array = array();
		$q = $this->db->get_where('category', array('id' => $id));
		if($q->num_rows() > 0) {
			$hq = $q->row();
			$parent = $this->db->get_where('category', array('id' => $hq->rootid));
			if($parent->num_rows() > 0) {
				$array[] = $hq;
				$newarray = $this->getRoot($hq->rootid);
				$array = array_merge($array, $newarray);
			} else {
				$array[] = $hq;
			}
		}

		return $array;
	}


	public function editCategory($id, $name) {
		$data = array('name' => $name);
		$this->db->where('id',$id);
		$this->db->update('category', $data);
		return true;
	}

	public function delCategory($id) {
		$data = array('is_deleted' => true);
		$this->db->where('id',$id);
		$this->db->update('category', $data);
		return true;
	}
}
?>