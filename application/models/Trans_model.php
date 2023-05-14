<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_model extends CI_Model {

	public function insertTrans($data) {
		$this->db->insert('trans', $data);
	}

	public function insertDetailTrans($data) {
		$this->db->insert('trans_detail', $data);
	}

	public function getTransWhere($where = null) {
		$this->db->order_by('order_placed_date', 'desc');
		$q =$this->db->get_where('trans', $where);
		return $q->result();
	}

	public function cancelOrder($orderid) {
		$this->db->where('id', $orderid);
		$this->db->update('trans', array('is_cancelled' => 1));
	}

	public function getTrans($id) {
		$q =$this->db->get_where('trans', array('id' => $id));
		$qd = $this->db->get_where('trans_detail', array('trans_id' => $id));
		$data = array('trans' => $q->row(), 'detil' => $qd->result());

		return $data;
	}

	public function updatePaymentProof($orderid, $filename, $trans_to) {
		$this->db->where('id', $orderid);
		$this->db->update('trans', array(
									'payment_proof_filename' 	=> $filename,
									'payment_to' 			 	=> $trans_to,
									'payment_confirmation_date' => date('Y-m-d H:i:s')
						  ));
	}

	public function updateTrans($id, $noresi, $status) {
		$q = $this->db->get_where('trans', array('id' => $id));
		$hq = $q->row();

		if($hq->status != "order_in_transit" && $status == "order_in_transit") {
			$data = array('no_resi' => $noresi, 'status' => $status, 'order_in_transit_date' => date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$this->db->update('trans', $data);
		} else if($status == "order_delivered") {
			$data = array('no_resi' => $noresi, 'status' => $status, 'order_delivered_date' => date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$this->db->update('trans', $data);
		} else {
			$data = array('no_resi' => $noresi, 'status' => $status);
			$this->db->where('id', $id);
			$this->db->update('trans', $data);
		}
	}

	public function getTransDetail($transid) {
		$this->db->join('product', 'product.id=trans_detail.product_id');
		$this->db->join('product_photo', 'product_photo.product_id = trans_detail.product_id', 'left');
		$this->db->join('variant', 'variant.id=trans_detail.variant_id', 'left');
		$this->db->select('product.*, product_photo.filename, trans_detail.qty, trans_detail.harga, variant.name as "variantname"');
		$q = $this->db->get_where('trans_detail', array('trans_id' => $transid));
		return $q->result();
	}
}
?>