<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function login($username, $password) {
		$q = $this->db->get_where('admin', array('username' => $username));

		if($q->num_rows()> 0) {
			$rq = $q->row();
			if(password_verify($password, $rq->password)) {
				//sukses
				$data = array(
				        'last_login' => date('Y-m-d H:i:s')
				);

				$this->db->where('username', $username);
				$this->db->update('admin', $data);
				return $rq;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getSetting() {
		$q = $this->db->get_where('setting', array('id' => 1));
		return $q->row();
	}

	public function updateAddress($kodepos, $address, $propinsi, $kota, $kecamatan) {
		$data = array(
					  'kodepos' 	=> $kodepos,
					  'kecamatan' 	=> $kecamatan,
					  'propinsi' 	=> $propinsi,
					  'kota' 		=> $kota,
					  'address' 	=> $address,
					 );
		$this->db->where('id', 1);
		$this->db->update('setting', $data);
	}

	public function updateKontak($whatsapp, $default_whatsapp_message,$ig_link,$tiktok_link, $lazada_link, $shopee_link) {
		$data = array(
					  'whatsapp' 	=> $whatsapp,
					  'default_whatsapp_message'	=> $default_whatsapp_message,
					  'ig_link'		=> $ig_link,
					  'tiktok_link'	=> $tiktok_link,
					  'lazada_link'	=> $lazada_link,
					  'shopee_link'	=> $shopee_link
					 );
		$this->db->where('id', 1);
		$this->db->update('setting', $data);
	}

	public function updatePoin($kurs_poin) {
		$data = array(
					  'kurs_poin' 	=> $kurs_poin,
					 
					 );
		$this->db->where('id', 1);
		$this->db->update('setting', $data);
	}

	public function updateBank($bank1, $bank2, $no_akun_bank1, $no_akun_bank2, $nama_akun_bank1, $nama_akun_bank2) {
		$data = array(
					  'bank1' 				=> $bank1,
					  'bank2' 				=> $bank2,
					  'no_akun_bank1' 		=> $no_akun_bank1,
					  'no_akun_bank2' 		=> $no_akun_bank2,
					  'nama_akun_bank1' 	=> $nama_akun_bank1,
					  'nama_akun_bank2' 	=> $nama_akun_bank2
					 );
		$this->db->where('id', 1);
		$this->db->update('setting', $data);
	}

	public function getSlides($where =  null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('display_order', 'asc');
		if($id != null) {
			$q = $this->db->get_where('slider', array('id' => $id));
		} else {
			$q = $this->db->get('slider');
		}

		return $q->result();
	}

	public function editSlideDown($id) {
		$result = $this->getSlides(array('id' => $id));

		if(count($result) >0) {
			$currentOrder = $result[0]->display_order;
			$data = array('display_order' => $currentOrder);
			$this->db->where('display_order',$currentOrder+1);
			$this->db->update('slider',$data);

			$data = array('display_order' => $currentOrder+1);
			$this->db->where('id',$id);
			$this->db->update('slider',$data);

			return true;
		} else {
			return false;
		}
	}

	public function editSlideUp($id) {
		$result = $this->getSlides(array('id' => $id));

		if(count($result) >0) {
			$currentOrder = $result[0]->display_order;
			$data = array('display_order' => $currentOrder);
			$this->db->where('display_order',$currentOrder-1);
			$this->db->update('slider',$data);

			$data = array('display_order' => $currentOrder-1);
			$this->db->where('id',$id);
			$this->db->update('slider',$data);

			return true;
		} else {
			return false;
		}
	}

	public function addSlide($title, $short_desc, $url = null, $filename, $url_caption = null) {
		$this->db->order_by('display_order', 'desc');
		$q = $this->db->get_where('slider', array('is_deleted' => 0));

		if($q->num_rows() > 0) {
			$hq = $q->row();
			$next = $hq->display_order + 1;	
			$data = array('title' => $title,
					  'short_desc' => $short_desc,
					  'url'		 => $url,
					  'filename'	 => $filename, 
					  'url_caption'	 => $url_caption,
					  'display_order' => $next);
			$this->db->insert('slider', $data);

			return true;
		} else {
			return false;
		}
	}

	public function editSlide($id,$title, $short_desc, $url = null, $filename=null, $url_caption = null) {		
		
		$data = array('title' => $title,
					  'short_desc' => $short_desc,
					  'url'		 => $url,
					  'url_caption'	 => $url_caption);
		if($filename != null) {
			$data['filename'] = $filename;
		}

		$this->db->where('id',$id);
		$this->db->update('slider',$data);
		return $id;
	}

	public function delSlide($id) {
		$result = $this->getSlides(array('id' => $id));

		if(count($result) >0) {
			$this->db->query('UPDATE slider SET display_order = display_order-1 WHERE display_order > '.$result[0]->display_order.'  AND is_deleted = 0;');
			$data = array('is_deleted' => 1);
			$this->db->where('id',$id);
			$this->db->update('slider', $data);
			return true;
		} else {
			return false;
		}
	}
}
?>