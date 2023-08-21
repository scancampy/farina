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

	public function useVoucher($voucher_code,$member_id, $transid) {
		$data = array(
					'voucher_code' 		=> $voucher_code,
					'member_id' 		=> $member_id,
					'transaction_id' 	=> $transid,
					'applied_date' 		=> date('Y-m-d H:i:s'),
				);
		$this->db->insert('voucher_used', $data);
	}

	public function assignVoucher($voucher_code, $member_id) {
		$q = $this->db->get_where('voucher_assign', array('voucher_code' => $voucher_code, 'member_id' => $member_id));

		if($q->num_rows() ==0) {
			$data = array('voucher_code' => $voucher_code, 'member_id' => $member_id);
			$this->db->insert('voucher_assign', $data);
			return true;
		} else {
			return false;
		}
	}

	public function revoke($assignid) {
		$this->db->where(array('id' => $assignid));
		$this->db->delete('voucher_assign');
	}

	public function checkPrivateVoucher($voucher_code, $member_id) {
		$q = $this->db->get_where('voucher_assign', array('voucher_code' => $voucher_code, 'member_id' => $member_id));

		if($q->num_rows() >0) {
			return true;
		} else {
			return false;
		}
	}

	public function getAssignedVoucher($voucher_code) {
		$this->db->join('member', 'member.id = voucher_assign.member_id');
		$this->db->select('member.*, voucher_assign.id as "vassingn_id"');
		$q = $this->db->get_where('voucher_assign', array('voucher_assign.voucher_code' => $voucher_code));

		return $q->result();
	}

	public function filterMemberAlreadyAssigned($voucher_code, $memberlist) {
		$newArray = array();
		foreach ($memberlist as $key => $value) {
			$q = $this->db->get_where('voucher_assign', array('voucher_code' => $voucher_code, 'member_id'=> $value->id));

			if($q->num_rows() == 0) {
				$newArray[] = $value;
			}
		}

		return $newArray;
	}

	public function getMemberVoucher($member_id) {
		$voucher = array();
		$q = $this->db->get_where('voucher_assign', array('member_id' => $member_id));

		foreach ($q->result() as $key => $value) {
			$voucher[] = $value->voucher_code;
		}

		// cek member vip atau bukan
		$q = $this->db->get_where('member', array('id' => $member_id));
		$hq = $q->row();

		if($hq->member_type == 'VIP') {
			$q = $this->db->get_where('voucher', array('voucher_type !=' => 'private', 'exp_date <=' => date('Y-m-d'), 'is_deleted' => 0));
		} else {
			$q = $this->db->get_where('voucher', array('voucher_type !=' => 'private', 'voucher_type != ' => 'vip', 'exp_date <=' => date('Y-m-d'), 'is_deleted' => 0));
		}

		foreach ($q->result() as $key => $value) {
			$voucher[] = $value->voucher_code;
		}

		// strip voucher used
		$newvoucher = array();
		foreach ($voucher as $key => $value) {
			$q = $this->db->get_where('voucher_used', array('member_id' => $member_id, 'voucher_code' => $value));
			if($q->num_rows() == 0) {
				$p = $this->db->get_where('voucher', array('voucher_code' => $value));

				$newvoucher[] = $p->row();
			}
		}
		

		return $newvoucher;
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

		//echo $this->db->last_query();
	//	die();
		return $q->result();
	}

	public function addVoucher($voucher_code, $voucher_type, $title, $description, $min_order = null, $discount_percentage = null, $discount_value = null, $exp_date = null, $pilihbrand = null, $pilihproduk = null ) {

		// cek voucher exist or not
		$q = $this->db->get_where('voucher', array('voucher_code' => preg_replace('/\s+/', '', $voucher_code)));

		if($q->num_rows() > 0) {
			return false;
		} else {
			$data = array('voucher_code' 		=> preg_replace('/\s+/', '', $voucher_code),
						  'voucher_type' 		=> $voucher_type,
						  'title'		 		=> $title,
						  'description'		 	=> $description, 
						  'min_order'	 		=> $min_order,
						  'discount_percentage' => $discount_percentage,
						  'discount_value'	    => $discount_value,
						  'exp_date'			=> $exp_date,
						  'product_id'			=> $pilihproduk,
						  'brand_id'			=> $pilihbrand
						);
			$this->db->insert('voucher', $data);

			return $voucher_code;
		}
	}

	public function editVoucher($voucher_code, $voucher_type, $title, $description, $min_order = null, $discount_percentage = null, $discount_value = null, $exp_date = null,$pilihbrand = null, $pilihproduk = null  ) {
		$data = array('voucher_type' 		=> $voucher_type,
					  'title'		 		=> $title,
					  'description'	 		=> $description, 
					  'min_order'	 		=> $min_order,
					  'discount_percentage' => $discount_percentage,
					  'discount_value'	    => $discount_value,
					  'exp_date'			=> $exp_date,
					  'product_id'			=> $pilihproduk,
					  'brand_id'			=> $pilihbrand);
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