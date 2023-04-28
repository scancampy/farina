<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct()
  {
          parent::__construct();
          // Your own constructor code
          if(empty($this->session->userdata('user'))) {
          	redirect('admin/dashboard/login');
          }
  }

  public function delete($id) {
  	$this->category_model->delCategory($id);
  	$this->session->set_flashdata('notif', 'success');
		$this->session->set_flashdata('message', 'Category deleted');
		redirect('admin/category');
  }

  private function _generateTree($array) {
  	if(empty($array)) { return; }
  	$str = '<ul style="list-style:none; padding:0px; margin-left:30px; border-left: 1px solid lightgray; margin-left:30px; padding-left:10px;">';
  	foreach ($array as $key => $value) {
  		$str .= '<li style="padding-bottom:8px; padding-top:8px; "><span><span class="fa fa-arrow-right" style="margin-left:-10px;"></span> '.$value->name.'</span>';

  		$str .= '<br/><span>
  		<a href="#" class="btnaddsub" data-toggle="modal" data-target="#modalAddSubCategory" rootid="'.$value->id.'"><small class="badge badge-primary">add sub category</small></a>
  		<a href="#" class="btnrenamesub" data-toggle="modal" data-target="#modalRenameCategory" renameid="'.$value->id.'" rename="'.$value->name.'"><small class="badge badge-secondary">rename category</small></a>
  		<a href="'.base_url('admin/category/delete/'.$value->id).'" onclick="return confirm(\'Are you sure you want to delete '.$value->name.' category?\');"><small class="badge badge-danger">delete</small></a></span>';

  		if(!empty($value->child)) {
  			$str.= $this->_generateTree($value->child);
  		}
  		$str .= '</li>';
  	}
  	$str .= '</ul>';

  	return $str;
  }

	public function index()
	{
		$data = array();
		$data['js'] = '';
		$data['title'] = 'Category';
		$data['name'] = $this->session->userdata('user')->name;
		$data['tree'] = $this->category_model->getCategoryTree(null);
		//print_r($data['tree']);

		$data['tree_html'] = $this->_generateTree($data['tree']);


		if($this->input->post('btnSubmit')) {
				$name = $this->input->post('name');
				$this->category_model->addCategory(null, $name);
				$this->session->set_flashdata('notif', 'success');
				$this->session->set_flashdata('message', 'New category created');
				redirect('admin/category');
		}

		if($this->input->post('btnSubmitSub')) {
				$name = $this->input->post('namesub');
				$rootid = $this->input->post('hiddenrootid');
				$this->category_model->addCategory($rootid, $name);
				$this->session->set_flashdata('notif', 'success');
				$this->session->set_flashdata('message', 'New sub category created');
				redirect('admin/category');
		}

		if($this->input->post('btnRenameSubmit')) {
				$name = $this->input->post('rename');
				$id = $this->input->post('hiddenrenameid');
				$this->category_model->editCategory($id, $name);
				$this->session->set_flashdata('notif', 'success');
				$this->session->set_flashdata('message', 'Category updated');
				redirect('admin/category');
		}

		
		// ajax sub
		$data['js'] .= '
		$("body").on("click", ".btnaddsub", function() {
			$("#hiddenrootid").val($(this).attr("rootid"));
		});
		';


		$data['js'] .= '
		$("body").on("click", ".btnrenamesub", function() {
			$("#hiddenrenameid").val($(this).attr("renameid"));
			$("#rename").val($(this).attr("rename"));
		});
		';

		$data['js'] .= '
				const Toast = Swal.mixin({
				      toast: true,
				      position: "top-end",
				      showConfirmButton: false,
				      timer: 3000
				    });';

		// notif
		if(@$this->session->flashdata('notif') == 'success') {
			$data['js'] .= '
				    Toast.fire({
				        icon: "success",
				        title: "'.$this->session->flashdata('message').'"
				      });';
		} else if(@$this->session->flashdata('notif') == 'error') {
			$data['js'] .= '
				    Toast.fire({
				        icon: "error",
				        title: "'.$this->session->flashdata('message').'"
				      });';
		}


		$this->load->view('admin/v_header', $data);
		$this->load->view('admin/v_category', $data);
		$this->load->view('admin/v_footer', $data);
	}
}