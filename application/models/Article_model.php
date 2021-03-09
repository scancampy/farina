<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {
	// Article Category
	public function getCategory($where =  null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('name');
		if($id != null) {
			$q = $this->db->get_where('article_category', array('id' => $id));
		} else {
			$q = $this->db->get('article_category');
		}

		return $q->result();
	}

	public function editCategory($id, $name) {
		$data = array('name' => $name);
		$this->db->where('id',$id);
		$this->db->update('article_category', $data);
		return true;
	}

	public function delCategory($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('article_category', $data);
		return true;
	}

	public function addCategory($name) {
		$data = array('name' => $name);
		$this->db->insert('article_category', $data);

		return true;
	}

	

	// ARTICLE
	public function addArticle($title,  $short_desc, $content, $is_published, $category_id, $article_type) {
		if($is_published == null) {
			$is_published = 0;
		}

		$data = array('title' => $title,
					  'is_published' => $is_published, 
					  'category_id' => $category_id, 
					  'short_desc' => $short_desc,
					  'content' => $content,
					  'created' => date('Y-m-d H:i:s'),
					  'article_type' => $article_type);
		
		$this->db->insert('article',$data);
		return $this->db->insert_id();
	}

	// TODO ganti jadi add Youtube
	public function addYoutube($article_id, $youtube) {
		$q = $this->db->get_where('article_media', array('article_id' => $article_id));
		$next = $q->num_rows() + 1;
		$data = array('article_id' => $article_id, 'media_type' => 'youtube', 'youtube_link' => $youtube, 'display_order' => $next);
		$this->db->insert('article_media', $data);
	}	

	public function editArticle($id, $title,  $short_desc, $content, $is_published, $category_id, $article_type) {
		if($is_published == null) {
			$is_published = 0;
		}
		
		$data = array('title' => $title,
					  'is_published' => $is_published, 
					  'category_id' => $category_id, 
					  'short_desc' => $short_desc,
					  'content' => $content,
					  'article_type' => $article_type);
		$this->db->where('id',$id);
		$this->db->update('article',$data);

		//echo $this->db->last_query();
		//die();
		return $id;
	}

	public function getArticle($where = null, $id = null, $limit = null, $offset = null) {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('title');
		if($limit != null) {
			$this->db->limit($limit, $offset);
		}
		$this->db->select('article.*, article_category.name as categoryname');
		$this->db->join('article_category', 'article_category.id = article.category_id');

		if($id != null) {
			$q = $this->db->get_where('article', array('article.id' => $id));
		} else {
			$q = $this->db->get('article');
		}



		return  $q->result();
	}

	public function addImageArticle($id, $filename) {
		$q = $this->db->get_where('article_media', array('article_id' => $id));
		$next = $q->num_rows() + 1;
		$data = array('article_id' => $id, 'media_type' => 'photo', 'filename' => $filename, 'display_order' => $next);
		$this->db->insert('article_media', $data);
	}

	public function getImageArticle($where = null, $article_id = null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}

		if($article_id != null) {
			$this->db->where('article_id', $article_id);
		}

		if($id != null) {
			$this->db->where('id', $id);
		}

		$this->db->order_by('display_order', 'acs');
		$q = $this->db->get('article_media');
		return $q->result();

	}

	public function delArticle($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('article', $data);
		return true;
	}
}
?>