<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Ordenes extends REST_Controller {
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

 //   public function get_pedido_get()
//    {
//		$data = $this->post();
//		$id_usuario = $data['usuario'];
//        $query = $this->db->query("SELECT * FROM `tbl_pedido_orden` WHERE `usuario` = $id_usuario && `completado` = 0 ");
//        $query -> result();
//        $this->response($query -> result());
//        
//    }

	public function get_pedido_post(){

		$data = $this->post();
		$condicion = array(
			'lugar_entrega' => $data['lugar_entrega'],
			'lugar_pedido' => $data['lugar_pedido'],
		);
		$this->db->select('*');
		$this->db->from('tbl_pedido_orden');
		$query = $this->db->or_where($condicion);
		$query = $this->db->where('completado',0);
		$query = $this->db->get();
		$this->response($query->result());

	}
	
	public function Crear_orden_post()
    {
		$data = $this->post();
		//$lugarpedido = $data['nombre_cliente'];
		$save = array(
			'usuario' => $data['usuario'],
			'fecha_hora_entrega' => $data['fecha_hora_entrega'],
			'lugar_entrega' => $data['lugar_entrega'],
			'telefono' => $data['telefono'],
			'nombre_cliente' => $data['nombre_cliente'],
			'correlativo' => $data['correlativo'],
			'lugar_pedido' => $data['lugar_pedido'],

			
		);
		$query = $this->db->insert('tbl_pedido_orden', $save);
		$query = $this->db->query("SELECT * FROM `tbl_pedido_orden` ORDER BY `id_pedido_orden` DESC LIMIT 1");
		
		//$query = $this->db->query("SELECT * FROM `tbl_corte` WHERE `sucursal` = $sucursal ORDER BY `id_corte` DESC LIMIT 1");
		//$query = $this->db->query("SELECT * FROM `tbl_corte` WHERE `sucursal` = $sucursal ORDER BY `id_corte` DESC LIMIT 1");
		$this->response($query->result());

		//echo utf8_encode(json_encode($retornar));
		//$query -> result();
		//$this->response($query->result());

		//echo utf8_encode(json_encode($retornar));
		//$query -> result();



		//$this->db->insert_id();

	}

	public function get_pedido_get()
    {

        $query = $this->db->query("SELECT * FROM `tbl_pedido_orden`");
        $query -> result();
        $this->response($query -> result());
        
	}
	
	
    public function guardar_orden_post()
    {
        $data = $this->post();
		//$sucursal = $data['sucursal'];
		$save = array(
			'pedido_orden ' => $data['pedido_orden'],
			'nombre_producto' => $data['nombre_producto'],
			'precio' => $data['precio'],
			'cantidad' => $data['cantidad'],
			'correlativo' => $data['correlativo'],
			'inventario ' => $data['inventario'],		
		);
		$query = $this->db->insert('tbl_pedido_orden_detalle', $save);
	}
	
	public function update_efectivo_post()
    {
        $data = $this->post();

		$efectivo = array(
			'efectivo_total' => $data['efectivo_total'], 
		);
		$this->db->where('id_pedido_orden', $data['id_pedido_orden']);
		$this->db->update('tbl_pedido_orden', $efectivo);
		$this->response($efectivo);
    }

}


