<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
     
   $this->user=$this->session->userdata('self_loggedin');
		$this->load->helper('cookie');
    }	

      

	public function index()
	{
		if(!empty($this->user)){
		$data['token']=$this->user['token'];
$this->load->view('index',$data);

}else{
  redirect("login");
}
    

		


	}
}
