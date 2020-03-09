<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Sucursal extends REST_Controller {
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

    public function get_sucursal_get()
    {

        $query = $this->db->query("SELECT * FROM `tbl_sucursal` WHERE `asignado` =  0 ");
        $query -> result();
        $this->response($query -> result());
        
	}
	public function get_sucursal_asignar_get()
    {

        $query = $this->db->query("SELECT * FROM `tbl_sucursal`");
        $query -> result();
        $this->response($query -> result());
        
    }

    public function update_sucursal_post()
    {
        $data = $this->post();

		if(!isset($data['id_sucursal'])){
			$this->response($data, 404);
		}
		$actualizarSucursal = array(
			'asignado' => $data['asignado'], 
		);
		$this->db->where('id_sucursal', $data['id_sucursal']);
		$this->db->update('tbl_sucursal', $actualizarSucursal);
		$this->response($actualizarSucursal);
    }

}


