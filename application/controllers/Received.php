<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Received extends CI_Controller {
	public function __construct() {
		parent::__construct();
        // set header CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header("Access-Control-Allow-Headers: *");
        header('Access-Control-Allow-Credentials: *');
        if ("OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {die();}
        // Construct the parent class
       
    }

	public function index()
	{
		$data = array();
		$data['setting'] = $this->admin_model->getSetting();
		$kurspoin = $data['setting']->kurs_poin;
		
		if($this->input->get('order_id')) {
			$id = $this->input->get('order_id');
			$data['order'] = $this->trans_model->getTrans($id);

			//print_r($data['order']);
			$member_id = $data['order']['trans']->member_id;

			$poin = $data['order']['trans']->total_trans-$data['order']['trans']->discount;
			$poin = floor($poin/$kurspoin);
			//die();
			

			if(empty($data['order']['trans'])) {
				redirect('notfound');
			} else {
				if($data['order']['trans']->status == 'order_in_transit') {
					$this->trans_model->insertPoin($member_id, $poin, 'Earned from transaction #'.$id);
					$this->trans_model->updateTrans($id, $data['order']['trans']->no_resi,'order_delivered');
					$this->session->set_flashdata('order_received','success');
					$this->session->set_flashdata('poin_earned', $poin);
					redirect('member/myorderdetails/'.$id);
				} else {
					redirect('member/myorderdetails/'.$id);
				}
			}
		}
	}	
}