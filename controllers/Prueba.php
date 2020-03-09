<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH ."/libraries/REST_Controller.php");

use Restserver\libraries\REST_Controller;

class Prueba extends REST_Controller {

    public function __construct(){
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
    }
    
    public function index_get()
    {
        $this->response("ProbandoLaApi");    
    }

    public function corte_get()
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM `tbl_corte`");
        $query -> result();
        $this->response($query -> result());
    
    }

    public function corte_detalle_get()
    {
        $query = $this->db->query("SELECT * FROM `tbl_detalle_corte`");
        $query -> result();
        $this->response($query -> result());
    
    }

    public function ingresar_corte_post($turno,$usuario,$cantidad,$efectivoinicial,$efectivofinal,$estado)
    {
        $this->load->database();
        
        $insertar = array(
                         'turno' => $turno,
                         'usuario'=> $usuario,
                         'Cantidad'=> $cantidad,
                         'efectivo_inicial'=> $efectivoinicial,
                         'efectivo_final'=> $efectivofinal,
                         'estado'=> $estado
                        );
        $this->db->insert('tbl_corte',$insertar);
                         
    }

    public function guardarCorte_post(){

		$data = $this->post();	
		$insertar = array(
                         'turno' => $data['turno'],
                         'usuario'=> $data['usuario'],
                         'Cantidad'=> $data['Cantidad'],
                         'efectivo_inicial'=> $data['efectivo_inicial'],
                         'efectivo_final'=> $data['efectivo_final'],
                         'estado'=> $data['estado'],
		);
		$this->db->insert('tbl_corte', $insertar);
		$this->response($insertar);
	}

    public function guardarCorte_Listado_post(){

        $data = $this->post();	
        $corte = json_decode($data, true);
        foreach ($corte as $datos)
        {
            $insertar = array(
                'turno' => $datos['turno'],
                'usuario'=> $datos['usuario'],
                'Cantidad'=> $datos['Cantidad'],
                'efectivo_inicial'=> $datos['efectivo_inicial'],
                'efectivo_final'=> $datos['efectivo_final'],
                'estado'=> $datos['estado'],
            );
            $this->db->insert('tbl_corte', $insertar);
            $insertar = null;
        }

		$this->response($insertar);
	}


}


