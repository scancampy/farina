<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
	// BRAND
	public function getBrand($where =  null, $id = null, $orderby='id',$ordertype='asc',$limit=null) {

		$this->db->order_by($orderby, $ordertype);

		if($limit!=null) {
			$this->db->limit($limit);
		}

		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('name');
		if($id != null) {
			$q = $this->db->get_where('brand', array('id' => $id));
		} else {
			$q = $this->db->get('brand');
		}

		return $q->result();
	}

	public function getBrandNextId() {
		$q = $this->db->query("SHOW TABLE STATUS LIKE 'brand'");
		$row = $q->row();
		return $row->Auto_increment;
	}

	public function editBrand($id, $name, $filename=null) {

		if($filename == null) {
			$data = array('name' => $name);
		} else {
			$data = array('name' => $name, 'logo_filename' => $filename);
		}
		
		$this->db->where('id',$id);
		$this->db->update('brand', $data);
		return true;
	}

	public function delBrand($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('brand', $data);
		return true;
	}

	public function addBrand($name, $filename) {
		$data = array('name' => $name, 'logo_filename' => $filename);
		$this->db->insert('brand', $data);

		return true;
	}

	// UNIT
	public function getUnit($where = null, $id =null) {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('unit_name');
		if($id != null) {
			$q = $this->db->get_where('product_unit', array('id' => $id));
		} else {
			$q = $this->db->get('product_unit');
		}

		return $q->result();
	}

	// PRODUCT
	public function addProduct($name, $in_stock, $brand_id, $category_id, $short_desc, $description, $weight, $product_unit_id, $price, $price_het) {
		if($in_stock == null) {
			$in_stock = 0;
		}

		$data = array('name' => $name,
					  'in_stock' 		=> $in_stock, 
					  'brand_id' 		=> $brand_id, 
					  'category_id'		=> $category_id,
					  'short_desc' 		=> $short_desc,
					  'description' 	=> $description,
					  'weight' 			=> $weight,
					  'product_unit_id' => $product_unit_id, 
					  'price' 			=> $price,
					  'price_het' 		=> $price_het);
		
		$this->db->insert('product',$data);
		return $this->db->insert_id();
	}

	public function addVariant($product_id,$name, $filename) {
		$data = array('product_id' => $product_id, 'name' => $name, 'filename' => $filename);
		$this->db->insert('variant', $data);
		return true;
	}

	public function delVariant($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id', $id);
		$this->db->update('variant', $data);
	}

	public function getVariant($where = null, $product_id=null, $id=null) {
		if($product_id != null) {
			$this->db->where('product_id', $product_id);
		}

		if($id != null) {
			$this->db->where('id', $id);
		}

		if($where != null) {
			$this->db->where($where);
		}

		$q = $this->db->get('variant');
		return $q->result();
	}	

	public function updateVariantStock($hiddenid, $stok) {
		foreach ($hiddenid as $key => $value) {
			$data = array('stok' => $stok[$key]);
			$this->db->where('id', $value);
			$this->db->update('variant', $data);
		}
	}

	public function updateVariantStockById($id, $stok) {
		$data = array('stok' => $stok);
		$this->db->where('id', $id);
		$this->db->update('variant', $data);
	}

	public function getVariantWithProduct($where = null, $product_id=null, $id=null) {
		if($product_id != null) {
			$this->db->where('variant.product_id', $product_id);
		}

		if($id != null) {
			$this->db->where('variant.id', $id);
		}

		if($where != null) {
			$this->db->where($where);
		}

		$this->db->join('product', 'product.id = variant.product_id', 'left');

		$this->db->select('product.name as "prodname", variant.*');
		$q = $this->db->get('variant');
		return $q->result();
	}	

	public function editProduct($id, $name, $in_stock, $brand_id, $category_id, $short_desc, $description, $weight, $product_unit_id, $price, $price_het) {
		if($in_stock == null) {
			$in_stock = 0;
		}
		
		$data = array('name' 			=> $name,
					  'in_stock' 		=> $in_stock, 
					  'brand_id' 		=> $brand_id, 
					  'category_id' 	=> $category_id, 
					  'short_desc' 		=> $short_desc,
					  'description' 	=> $description,
					  'weight' 			=> $weight,
					  'product_unit_id' => $product_unit_id, 
					  'price' 			=> $price,
					  'price_het' 		=> $price_het);
		$this->db->where('id',$id);
		$this->db->update('product',$data);
		return $id;
	}

	public function getProduct($where = null, $id = null, $limit = null, $offset = null, $orderType = 'asc') {
		if($where != null) {
			$this->db->where($where);
		}
		$this->db->order_by('name', $orderType);
		if($limit != null) {
			$this->db->limit($limit, $offset);
		}
		$this->db->select('product.*, brand.name as brandname');
		$this->db->join('brand', 'brand.id = product.brand_id');

		$this->db->select('category.name as categoryname');
		$this->db->join('category', 'category.id = product.category_id','left');

		$this->db->select('product_unit.unit_name');
		$this->db->join('product_unit', 'product_unit.id = product.product_unit_id');

		if($id != null) {
			$q = $this->db->get_where('product', array('product.id' => $id));
		} else {
			$q = $this->db->get('product');
		}

		//echo $this->db->last_query();


		return  $q->result();
	}

	public function addImageProduct($id, $filename) {
		$q = $this->db->get_where('product_photo', array('product_id' => $id));
		$next = $q->num_rows() + 1;
		$data = array('product_id' => $id, 'filename' => $filename, 'display_order' => $next);
		$this->db->insert('product_photo', $data);
	}

	public function getImageProduct($where = null, $product_id = null, $id = null) {
		if($where != null) {
			$this->db->where($where);
		}

		if($product_id != null) {
			$this->db->where('product_id', $product_id);
		}

		if($id != null) {
			$this->db->where('id', $id);
		}

		$this->db->order_by('display_order', 'acs');
		$q = $this->db->get('product_photo');
		return $q->result();

	}

	public function delImageProduct($id) {
		$this->db->where('id', $id);
		$this->db->delete('product_photo');
	}

	public function delProduct($id) {
		$data = array('is_deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('product', $data);
		return true;
	}
}
?>