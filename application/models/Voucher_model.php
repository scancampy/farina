<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_model extends CI_Model {
	public function checkVouhcerUsed($member_id, $voucher_code) {
		$q = $this->db->get_where('voucher_used', array('member_id' => $member_id, 'voucher_code' => $voucher_code));

		if($q->num_rows() > 0) {
			//terpakai
			return false;
		} else {
			// available
			return true;
		}
	}

	public function getVoucher($where =  null, $voucher_code = null) {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('created', 'desc');
		if($voucher_code != null) {
			$q = $this->db->get_where('voucher', array('voucher_code' => $voucher_code));
		} else {
			$q = $this->db->get('voucher');
		}

		return $q->result();
	}

	public function addVoucher($voucher_code, $voucher_type, $title, $description, $min_order = null, $discount_percentage = null, $discount_value = null, $exp_date = null ) {

		// cek voucher exist or not
		$q = $this->db->get_where('voucher', array('voucher_code' => preg_replace('/\s+/', '', $voucher_code)));

		if($q->num_rows() > 0) {
			return false;
		} else {
			$data = array('voucher_code' => preg_replace('/\s+/', '', $voucher_code),
						  'voucher_type' => $voucher_type,
						  'title'		 => $title,
						  'description'	 => $description, 
						  'min_order'	 => $min_order,
						  'discount_percentage' => $discount_percentage,
						  'discount_value'	    => $discount_value,
						  'exp_date'			=> $exp_date);
			$this->db->insert('voucher', $data);

			return $voucher_code;
		}
	}

	public function editVoucher($voucher_code, $voucher_type, $title, $description, $min_order = null, $discount_percentage = null, $discount_value = null, $exp_date = null ) {
		$data = array('voucher_type' => $voucher_type,
					  'title'		 => $title,
					  'description'	 => $description, 
					  'min_order'	 => $min_order,
					  'discount_percentage' => $discount_percentage,
					  'discount_value'	    => $discount_value,
					  'exp_date'			=> $exp_date);
		$this->db->where('voucher_code',$voucher_code);
		$this->db->update('voucher', $data);


		return $voucher_code;
	}

	public function editVoucherImg($voucher_code, $filename) {
		$data = array('filename' => $filename);
		$this->db->where('voucher_code',$voucher_code);
		$this->db->update('voucher', $data);
		return true;
	}

	public function delVoucher($voucher_code) {
		$data = array('is_deleted' => 1);
		$this->db->where('voucher_code',$voucher_code);
		$this->db->update('voucher', $data);
		return true;
	}

}
?>