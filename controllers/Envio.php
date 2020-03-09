<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Envio extends REST_Controller {
	public function __construct(){
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('date');

	}
    
    public function index_get()
    {
        $this->response("ProbandoLaApi");    
    }

 //   public function get_pedido_get()
//    {
//		$data = $this->post();
//		$id_usuario = $data['usuario'];
//        $query = $this->db->query("SELECT * FROM `tbl_pedido_orden` WHERE `usuario` = $id_usuario && `completado` = 0 ");
//        $query -> result();
//        $this->response($query -> result());
//        
//    }

	public function get_envio_post(){

		$data = $this->post();
		$condicion = array(
			'origen' => $data['origen'],
			'destino' => $data['destino'],
		);
		$this->db->select('*');
		$this->db->from('tbl_envios');
		$query = $this->db->or_where($condicion);
		$query = $this->db->where('estado',0);
		$query = $this->db->get();
		$this->response($query->result());

	}
	
	public function Crear_envio_post()
    {
		$data = $this->post();
		$save = array(
			'origen' => $data['origen'],
			'destino' => $data['destino'],
			'usuario' => $data['usuario'],		
		);
		$query = $this->db->insert('tbl_envios', $save);
		//$query = $this->db->query("SELECT * FROM `tbl_envio` WHERE `origen` =  && `completado` = 0 ");
		$this->response($save);
		//echo utf8_encode(json_encode($retornar));
		//$query -> result();


		//$this->db->insert_id();

	}

	public function get_envio_get()
    {

        $query = $this->db->query("SELECT * FROM `tbl_envios`");
        $query -> result();
        $this->response($query -> result());
        
	}


}


