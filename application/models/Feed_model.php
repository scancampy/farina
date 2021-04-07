<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed_model extends CI_Model {
	public function addPost($member_id, $content, $is_headline = 0, $is_from_admin = 0) {
		$data = array(
					'content'   	=> $content,
					'feed_date' 	=> date('Y-m-d H:i:s'),
					'member_id' 	=> $member_id,
					'is_headline' 	=> $is_headline,
					'is_from_admin' => $is_from_admin
				);
		$this->db->insert('feed', $data );
		return $this->db->insert_id();
	}

	public function getPost($id = null, $where = null, $limit = 10, $offset = 0, $order_by = "feed_date", $order_type="desc") {
		$q = $this->db->query("SELECT feed.*, member.first_name, member.member_type, member.id as 'memberid' FROM feed INNER JOIN member ON member.id = feed.member_id ORDER BY ".$order_by." ".$order_type." LIMIT ".$limit." OFFSET ".$offset.";");

		return $q->result();
	}

	public function getImagePost($where = null, $feed_id = null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}

		if($feed_id != null) {
			$this->db->where('feed_id', $feed_id);
		}

		if($id != null) {
			$this->db->where('id', $id);
		}

		$this->db->order_by('display_order', 'acs');
		$q = $this->db->get('feed_media');
		return $q->result();

	}

	public function addImagePost($id, $filename) {
		$q = $this->db->get_where('feed_media', array('feed_id' => $id));
		$next = $q->num_rows() + 1;
		$data = array('feed_id' => $id, 'filename' => $filename, 'display_order' => $next);
		$this->db->insert('feed_media', $data);
	}

	public function checkLike($id, $member_id) {
		$q = $this->db->get_where('feed_likes', array('member_id' => $member_id, 'feed_id' => $id));

		if($q->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
?>