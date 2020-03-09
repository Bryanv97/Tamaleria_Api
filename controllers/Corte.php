<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Corte extends REST_Controller {
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

    public function get_ncorte_post()
    {
		$data = $this->post();
		$fecha = date("Y-m-d");
		$condicion = array(
			'sucursal' => $data['sucursal'],
			'fecha_hora' => $fecha,
		);
		$this->db->select('*');
		$this->db->from('tbl_corte');
		$this->db->like($condicion);
		$query = $this->db->get();
		$this->response($query->result());
        
    }

    public function get_corte_get()
    {

        $query = $this->db->query("SELECT * FROM `tbl_corte` where `estado` = 0 ");
        $query -> result();
		$this->response($save);
        
    }

    public function Iniciar_corte_post()
    {
		$data = $this->post();
		$sucursal = $data['sucursal'];
		$save = array(
			'turno' => $data['turno'],
			'usuario' => $data['usuario'],
			'sucursal' => $data['sucursal'],
			'efectivo_inicial' => $data['efectivo_inicial'],
			'efectivo_final' => $data['efectivo_final'],
			'estado' => $data['estado'],
			
		);
		$query = $this->db->insert('tbl_corte', $save);
		$query = $this->db->query("SELECT * FROM `tbl_corte` WHERE `sucursal` = $sucursal ORDER BY `id_corte` DESC LIMIT 1");

		//echo utf8_encode(json_encode($retornar));
		//$query -> result();
		$this->response($query->result());


		//$this->db->insert_id();

	}
	public function Finalizar_corte_post()
    {
		$data = $this->post();
		$save = array(
			'estado' => $data['estado'],			
		);
		$this->db->where('id_corte', $data['id_corte']);
		$query = $this->db->update('tbl_corte', $save);
		//Existe Usuario y Clave en BD
		$this->response($save);
	}
	public function get_token_get()
	{
		$tokenData = 'Hello World!';
        
        // Create a token
        $token = AUTHORIZATION::generateToken($tokenData);
        // Set HTTP status code
        $status = parent::HTTP_OK;
        // Prepare the response
        $response = ['status' => $status, 'token' => $token];
        // REST_Controller provide this method to send responses
        $this->response($response, $status);

	}

}


