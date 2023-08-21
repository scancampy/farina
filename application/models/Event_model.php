<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
	// ARTICLE
	public function addEvent($name,  $short_desc, $content, $event_date, $event_time, $icon, $need_registration, $host, $event_fee = 0, $points =0) {
		
		$data = array('name' => $name,
					  'need_registration' => $need_registration, 
					  'icon' => $icon, 
					  'host' => $host, 
					  'short_desc' => $short_desc,
					  'content' => $content,
					  'event_fee'	=> $event_fee,
					  'points'	=> $points,
					  'event_date' => $event_date.' '.$event_time.':00'
					);
		
		$this->db->insert('event',$data);
		return $this->db->insert_id();
	}

	public function register($event_id,$member_id, $phone, $filename ) {
		$data = array(
					'event_id'					=> $event_id,
					'member_id'					=> $member_id,
					'phone'						=> $phone,
					'payment_proof_filename'	=> $filename,
					'payment_confirmation_date'	=> date('Y-m-d'),
					'status'					=> 'pending'
				);
		$this->db->insert('event_registrant', $data);
	}

	public function getMemberFromEvent($event_id) {
		$this->db->join('member', 'member.id = event_registrant.member_id');
		$this->db->select('event_registrant.*, member.first_name, member.email, member.last_name');
		$q = $this->db->get_where('event_registrant', array('event_id' => $event_id));

		return $q->result();
	}

	public function getRegister($event_id, $member_id) {
		$q = $this->db->get_where('event_registrant', array('event_id' => $event_id, 'member_id' => $member_id));

		if($q->num_rows() >0) {
			return $q->row();
		} else {
			return false;
		}
	}

	public function updateRegistrantStatus($event_id, $member_id, $status) {
		$q = $this->db->get_where('event_registrant', array('event_id'=>$event_id,'member_id'=>$member_id));

		
		if($q->num_rows() >0) {
			$hq = $q->row();

			if($hq->status == 'pending' && $status == 'registered') {
				// generate point
				$p = $this->db->get_where('event', array('id' => $event_id));
				$hp = $p->row();
				$points = $hp->points;

				$data = array(
					'member_id' 	=> $member_id,
					'point_earned'	=> date('Y-m-d H:i:s'),
					'point'			=> $points,
					'notes'			=> 'Earned from registered in event '.$hp->name
				);
				$this->db->insert('point', $data);
			}

			$this->db->where('event_id', $event_id);
			$this->db->where('member_id', $member_id);
			$this->db->update('event_registrant', array('status' => $status));
		}

		
		//return $q->result();
	}

	public function getMemberEvent($member_id) {
		$this->db->join('event', 'event.id=event_registrant.event_id');
		$this->db->select('event.*, event_registrant.status, event_registrant.member_id, event_registrant.payment_confirmation_date');
		$this->db->order_by('payment_confirmation_date','desc');
		$q = $this->db->get_where('event_registrant', array('member_id' => $member_id));
		return $q->result();
	}

	public function addYoutube($id, $youtube) {
		$q = $this->db->get_where('event_media', array('event_id' => $id));
		$next = $q->num_rows() + 1;
		$data = array('event_id' => $id, 'media_type' => 'youtube', 'youtube_link' => $youtube, 'display_order' => $next);
		$this->db->insert('event_media', $data);
	}	

	public function editEvent($id, $name,  $short_desc, $content, $event_date, $event_time, $icon, $need_registration, $host, $event_fee = 0, $points =0) {
		$data = array('name' => $name,
					  'need_registration' => $need_registration, 
					  'icon' => $icon, 
					  'host' => $host, 
					  'short_desc' => $short_desc,
					  'content' => $content,
					  'event_fee'	=> $event_fee,
					  'points'	=> $points,
					  'event_date' => $event_date.' '.$event_time.':00'
					);
		$this->db->where('id',$id);
		$this->db->update('event',$data);

		return $id;
	}

	public function getEvent($where = null, $id = null, $limit = null, $offset = null, $order_type = 'desc') {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('event_date', $order_type);
		if($limit != null) {
			$this->db->limit($limit, $offset);
		}

		if($id != null) {
			$q = $this->db->get_where('event', array('id' => $id));
		} else {
			$q = $this->db->get('event');
		}

		return  $q->result();
	}

	public function addImageEvent($id, $filename) {
		$q = $this->db->get_where('event_media', array('event_id' => $id));
		$next = $q->num_rows() + 1;
		$data = array('event_id' => $id, 'media_type' => 'photo', 'filename' => $filename, 'display_order' => $next);
		$this->db->insert('event_media', $data);
	}

	public function getImageEvent($where = null, $event_id = null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}

		if($event_id != null) {
			$this->db->where('event_id', $event_id);
		}

		if($id != null) {
			$this->db->where('id', $id);
		}

		$this->db->order_by('display_order', 'acs');
		$q = $this->db->get('event_media');
		return $q->result();

	}

	public function delEvent($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('event', $data);
		return true;
	}
}
?>