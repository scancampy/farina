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
		$this->db->join('member','member.id = trans.member_id', 'left');
		$this->db->order_by('order_placed_date', 'desc');
		$this->db->select('trans.*, member.first_name as "memberfname", member.last_name as "memberlname", member.email');
		$q =$this->db->get_where('trans', $where);
		//echo $this->db->last_query();
		return $q->result();
	}

	public function cancelOrder($orderid) {
		$this->db->where('id', $orderid);
		$this->db->update('trans', array('is_cancelled' => 1));
	}

	public function getTrans($id) {
		$q =$this->db->get_where('trans', array('id' => $id));
		$this->db->join('product', 'product.id=trans_detail.product_id', 'left');
		$this->db->join('product_photo', 'product_photo.product_id=trans_detail.product_id', 'left');
		$this->db->join('variant', 'variant.id=trans_detail.variant_id', 'left');
		$this->db->select('trans_detail.*, product.name, variant.name as "variantname", product_photo.filename');
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

	public function updateIsReviewedTrans($id) {
		$this->db->where('id', $id);
		$this->db->update('trans', array('is_reviewed' => true));
	}

	public function insertPoin($member_id, $poin, $notes) {
		$data = array(
					'member_id' 	=> $member_id,
					'point_earned'	=> date('Y-m-d H:i:s'),
					'point'			=> $poin,
					'notes'			=> $notes
				);
		$this->db->insert('point', $data);
	}

	public function getPoin($member_id) {
		$this->db->order_by('point_earned', 'desc');
		$q = $this->db->get_where('point', array('member_id' => $member_id));
		return $q->result();
	}

	public function getTransDetail($transid) {
		$myquery = "SELECT `product`.*, (SELECT product_photo.filename FROM product_photo WHERE product_photo.product_id = `product`.`id` LIMIT 1), `trans_detail`.`qty`, `trans_detail`.`harga`, `variant`.`name` as `variantname`
FROM `trans_detail`
LEFT JOIN `product` ON `product`.`id` = `trans_detail`.`product_id`
LEFT JOIN `variant` ON `variant`.`id`=`trans_detail`.`variant_id`
WHERE `trans_detail`.`trans_id` = '".$transid."';";

		/*$this->db->join('product', 'product.id=trans_detail.product_id','left');
		$this->db->join('product_photo', 'product_photo.product_id = trans_detail.product_id', 'left');
		$this->db->join('variant', 'variant.id=trans_detail.variant_id', 'left');
		$this->db->select('product.*, product_photo.filename, trans_detail.qty, trans_detail.harga, variant.name as "variantname"');*/
		$q = $this->db->query($myquery);

		//echo $this->db->last_query();
		return $q->result();
	}

	public function reviewProduct($id, $rating, $review) {
		$data = array('rating' => $rating, 'review' => $review);
		$this->db->where('id', $id);
		$this->db->update('trans_detail', $data);
	}

	public function getProductReview($id) {
		$this->db->join('trans', 'trans.id = trans_detail.trans_id', 'left');
		$this->db->join('member', 'member.id = trans.member_id', 'left');
		$this->db->join('variant', 'variant.id = trans_detail.variant_id', 'left');
		$this->db->select('trans_detail.*, member.first_name, variant.name as "variantname", trans.order_placed_date');
		$this->db->order_by('trans.order_placed_date', 'desc');
		$q = $this->db->get_where('trans_detail', array('trans_detail.product_id' => $id, 'trans_detail.show_review' => TRUE));
		return $q->result();
	}

	public function getProductRating($id) {
		$this->db->select_sum('rating');
		$q = $this->db->get_where('trans_detail', array('product_id' => $id, 'show_review' => TRUE));
		$hasil = $q->row();
		$rating = $hasil->rating;
		$h = $this->db->get_where('trans_detail', array('product_id' => $id, 'show_review' => TRUE));
		if($h->num_rows() > 0) {
			return $rating/$h->num_rows();
		} else {
			return 0;
		}
	}

	public function getProductRatingNumber($id) {
		$q = $this->db->get_where('trans_detail', array('product_id' => $id, 'show_review' => TRUE));

		return $q->num_rows();
	}

	public function rejectProductReview($id) {
		$this->db->where('id', $id);
		$this->db->update('trans_detail', array('show_review' => FALSE));
	}

	public function approveProductReview($id) {
		$this->db->where('id', $id);
		$this->db->update('trans_detail', array('show_review' => TRUE));
	}

	public function getProductsNeedReview($transdetailid = null) {
		$this->db->join('product', 'product.id=trans_detail.product_id', 'left');
		$this->db->join('brand', 'brand.id=product.brand_id', 'left');
		$this->db->select('trans_detail.*, product.name, brand.name as "brandname"');

		if(!empty($transdetailid)) {
			$this->db->where('trans_detail.id', $transdetailid);
		}

		$q = $this->db->get_where('trans_detail', array('show_review' => NULL, 'rating !=' => NULL));

		$hq = $q->result();
		$data = array();
		foreach ($hq as $key => $value) {
			$data[$key]['data'] = $value;
			$data[$key]['rating'] = $this->getProductRating($value->product_id);
			$data[$key]['total'] = $this->getProductRatingNumber($value->product_id);
		}

		return $data;
	}
}
?>