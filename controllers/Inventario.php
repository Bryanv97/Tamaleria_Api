<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Inventario extends REST_Controller {
	public function __construct(){
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
		//$this->load->helper('url');
		//$this->load->helper(['jwt', 'authorization']);   
	}
    
    public function index_get()
    {
        $this->response("ProbandoLaApi",400);    
    }

    public function get_inventario_get()
    {

        $this->db->select('id_inventario ');
        $this->db->select('nombre_producto ');
        $this->db->select('precio ');
        $this->db->from('tbl_inventario');
        $this->db->where('tipo_producto',1);
		//$this->db->like($condicion);
		$query = $this->db->get();
		$this->response($query->result());
        
    }

	

}


