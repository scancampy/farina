<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messaging_model extends CI_Model {
	public function addMessage($title, $content, $delivered_to, $members=null) {
		$data = array(
						'title' 		=> $title,
						'content' 		=> $content,
						'delivered_to' 	=> $delivered_to,
						'created'		=> date('Y-m-d H:i:s')
					 );
		$this->db->insert('messaging', $data);
		$id = $this->db->insert_id();

		if($members != null) {
			foreach ($members as $key => $value) {
				$data = array(
					'messaging_id'		=> $id,
					'member_id'			=> $value
				);
				$this->db->insert('messaging_status', $data);
			}
		}

		return $id;
	}

	public function getMemberMessage($member_id) {
		$this->db->join('messaging', 'messaging.id = messaging_status.messaging_id');
		$this->db->order_by('messaging.created', 'desc');
		$this->db->select('messaging.id as "msgid", messaging.title, messaging.content, messaging.created, messaging_status.*');
		$q = $this->db->get_where('messaging_status', array('member_id' => $member_id, 'messaging.is_deleted' => null, 'messaging_status.is_deleted' => null));
		return $q->result();
	}

	public function readMessage($id, $member_id) {
		$q = $this->db->get_where('messaging_status', array('member_id' => $member_id, 'messaging_id' => $id));
		if($q->num_rows() >0) {
			$hq = $q->row();
			$this->db->where('id', $hq->id);
			$this->db->update('messaging_status', array('is_read' => true));

			$p = $this->db->get_where('messaging', array('id' => $id));
			return $p->row();
		} else {
			return false;
		}
	}

	public function getMessage($id = null, $where = null, $order_by = null, $order_type = null) {
		if(!empty($id)) {
			$this->db->where('id', $id);
		}

		if(!empty($where)) {
			$this->db->where($where);
		}
		if(!empty($order_by)) {
			$this->db->order_by($order_by, $order_type);
		}

		$q = $this->db->get('messaging');
		return $q->result();
	}

	public function addFilesMessage($id, $filename, $title) {
		$data = array('messaging_id' => $id, 'filename' => $filename, 'title' => $title);
		$this->db->insert('messaging_files', $data);
	}

	public function editMessage($id, $title, $content) {
		$data = array(
			'title'		=> $title,
			'content'	=> $content
		);

		$this->db->where('id', $id);
		$this->db->update('messaging', $data);
	}

	public function delFileMessage($id) {
		$this->db->where('id', $id);
		$this->db->delete('messaging_files');
	}

	public function getMessageFiles($id) {
		$q = $this->db->get_where('messaging_files', array('messaging_id' => $id));
		return $q->result();
	}

	public function getMessageMembers($id) {
		$this->db->join('member', 'member.id = messaging_status.member_id', 'left');
		$this->db->select('messaging_status.*, member.first_name, member.last_name, member.email');
		$q = $this->db->get_where('messaging_status', array('messaging_status.messaging_id' => $id));

		return $q->result();
	}
}
?>