<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Login extends REST_Controller {
	public function __construct(){
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}
    
    public function index_get()
    {
        $this->response("ProbandoLaApi");    
	}
	
	public function getuser_get($ROL1,$ROL2)
	{
			
			$query = $this->db->query("SELECT * FROM `tbl_usuario` WHERE `rol` = $ROL1 || `rol`= $ROL2");
			$this->response($query->result());
		
	}

	public function Login_post(){

		$data = $this->post();
		$condicion = array(
			'username' => $data['username'],
			'password' => $data['password'],
		);		
		$query = $this->db->get_where('tbl_usuario', $condicion);
		//Existe Usuario y Clave en BD
		$this->response($query->result());

	}

}


