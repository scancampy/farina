<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
	// ARTICLE
	public function addEvent($name,  $short_desc, $content, $event_date, $event_time, $icon, $need_registration, $host) {
		
		$data = array('name' => $name,
					  'need_registration' => $need_registration, 
					  'icon' => $icon, 
					  'host' => $host, 
					  'short_desc' => $short_desc,
					  'content' => $content,
					  'event_date' => $event_date.' '.$event_time.':00'
					);
		
		$this->db->insert('event',$data);
		return $this->db->insert_id();
	}

	public function addYoutube($id, $youtube) {
		$q = $this->db->get_where('event_media', array('event_id' => $id));
		$next = $q->num_rows() + 1;
		$data = array('event_id' => $id, 'media_type' => 'youtube', 'youtube_link' => $youtube, 'display_order' => $next);
		$this->db->insert('event_media', $data);
	}	

	public function editEvent($id, $name,  $short_desc, $content, $event_date, $event_time, $icon, $need_registration, $host) {
		$data = array('name' => $name,
					  'need_registration' => $need_registration, 
					  'icon' => $icon, 
					  'host' => $host, 
					  'short_desc' => $short_desc,
					  'content' => $content,
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