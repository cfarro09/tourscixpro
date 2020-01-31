<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Tourscix extends REST_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('General_model');
	}

	// new api
	public function syncManage_post() 
	{
		$codUpdateFestividad = html_purify($this->input->post('codUpdateFestividad'));
		$codUpdateLugar = html_purify($this->input->post('codUpdateLugar'));
		$views = html_purify($this->input->post('views'));
		
		if($views && isset($views) && $views != "")
		{
		    $views = json_decode($views);
		    foreach ($views->lugares as $id => $valor)
                $this->General_model->update_dynamic('lugar_turisticoaux', array("cod_lugar" => $id), array("views" => 'views + ' . $valor));
            
            foreach ($views->festividades as $id => $valor) 
                $this->General_model->update_dynamic('festividad', array("cod_fest" => $id), array("views" => 'views + ' . $valor));
		}

		$res_max = $this->General_model->get_data_dynamic('lugar_turisticoaux', "max(codUpdate) as max");
		$maxCodeLugar = $res_max[0]->max;
		$res_max1 = $this->General_model->get_data_dynamic('festividad', "max(codUpdate) as max");
		$maxCodeFestividad = $res_max1[0]->max;

		if($codUpdateLugar && $codUpdateLugar != 0)
		{
			$lugares = $this->General_model->get_data_dynamic('lugar_turisticoaux', "*", false, array('codUpdate >' => $codUpdateLugar));
			$festividades = $this->General_model->get_data_dynamic('festividad', "*", false, array('codUpdate >' => $codUpdateFestividad));

			$response = array(
				'codUpdateFestividad' => $maxCodeFestividad,
				'codUpdateLugar' => $maxCodeLugar,
				'lugares' => $lugares ? $lugares : [], 
				'festividades' => $festividades ? $festividades : [],
				'aviso' => array("execute" => false)
			);
		}
		else
		{
			$lugares = $this->General_model->get_data_dynamic('lugar_turisticoaux', "*", false, array('estado' => "H"));
			$festividades = $this->General_model->get_data_dynamic('festividad', "*", false, array('estado' => "H"));

			$response = array(
				'codUpdateFestividad' => $maxCodeFestividad,
				'codUpdateLugar' => $maxCodeLugar,
				'lugares' => $lugares, 
				'festividades' => $festividades,
				'aviso' => array("execute" => false)
			);
		}
		$query = 'select a.titulo, a.descripcion, a.imagen from propiedades p inner join aviso a on a.id = p.valor where p.llave = "avisoid" and p.valor <> "0"';
		
		$res = $this->General_model->get_query($query);
		if($res){
			$response["aviso"] = array(
				"execute" => true,
				"titulo" => $res[0]->titulo,
				"descripcion" => $res[0]->descripcion,
				"imagen" => $res[0]->imagen
			);
		}

		$this->response($response);
	}
	//end newapi

	public function getCount_get() {
		$count_lugares = $this->General_model->get_data_dynamic('lugar_turisticoaux', "count(*) as count")[0]->count;
		$count_festividades = $this->General_model->get_data_dynamic('festividad', "count(*) as count")[0]->count;
		$total = $count_festividades + $count_lugares;

		$this->response(array('count' => $total));
	}
	public function getAll_get() {
		$lugares = $this->General_model->get_data_dynamic('lugar_turisticoaux', "*", false, array('estado' => "H"));
		$festividades = $this->General_model->get_data_dynamic('festividad', "*", false, array('estado' => "H"));

		$response = array(
			'countlugares' => count($lugares),
			'lugares' => $lugares, 
			'festividades' => $festividades
		);
		$this->response($response);
	}
	public function getFotosLugares_post(){
		$cod_lugar = html_purify($this->input->post('cod_lugar'));
		$limit = html_purify($this->input->post('limit'));
		if ($cod_lugar) {
			if ($limit) {
				$fotos = $this->General_model->get_data_dynamic('foto_atractivo', "*", false, array('cod_lugar' => (int) $cod_lugar), true);
			}else{
				$fotos = $this->General_model->get_data_dynamic('foto_atractivo', "*", false, array('cod_lugar' => (int) $cod_lugar));
			}
			$this->response($fotos);
		}else{
			$this->response("false");
		}
	}
	
	public function getFotos_post(){
		$cod = html_purify($this->input->post('cod'));
		$type = html_purify($this->input->post('type'));
		if ($cod) {
			if ($type == "lugar") {
				$fotos = $this->General_model->get_data_dynamic('foto_atractivo', "*", false, array('cod_lugar' => (int) $cod));
			}else{
				$fotos = $this->General_model->get_data_dynamic('foto_fest', "*", false, array('cod_fest' => (int) $cod));
			}
			$this->response($fotos);
		}else{
			$this->response("false");
		}
	}
	public function getFotosFestividades_post(){
		$cod_fest = html_purify($this->input->post('cod_fest'));
		$limit = html_purify($this->input->post('limit'));
		if ($cod_fest) {
			if ($limit) {
				$fotos = $this->General_model->get_data_dynamic('foto_fest', "*", false, array('cod_fest' => (int) $cod_fest), true);
			}else{
				$fotos = $this->General_model->get_data_dynamic('foto_fest', "*", false, array('cod_fest' => (int) $cod_fest));
			}
			$this->response($fotos);
		}else{
			$this->response("false");
		}
	}
	public function setValoracion_post(){
		$cod_lugar = html_purify($this->input->post('cod_lugar'));
		$valoracion = html_purify($this->input->post('valoracion'));
		$votantes = html_purify($this->input->post('votantes'));
		if ($cod_lugar && $valoracion && $votantes) {
		    try{
		        $response = $this->General_model->edit_dynamic('lugar_turisticoaux', array("cod_lugar" => $cod_lugar), array("Valoracion" => $valoracion, "votantes" => $votantes));
			    $this->response($response);
		    }catch(Exception $e){
		        $this->response(array("success" => true, "msg" => $e->getMessage()));
		    }
			
		}else{
			$this->response(array("success" => false, "msg" => "Await code"));
		}
	}
	public function actualizarmensualanual_get()
    {
		$response = $this->General_model->cronfestividad();
		$this->response($response);
    }
	public function insertRecomendacion_post(){
		$asunto = html_purify($this->input->post('asunto'));
		$mensaje = html_purify($this->input->post('mensaje'));
		$nombre = html_purify($this->input->post('nombre'));
		$contacto = html_purify($this->input->post('contacto'));
		if ($asunto && $mensaje && $nombre && $contacto) {
			$data = array(
				'asunto' => $asunto, 
				'mensaje' => $mensaje, 
				'nombre' => $nombre, 
				'telefono' => $contacto
			);
			$response = $this->General_model->insert_dynamic('recomendacion', $data);
			$this->response($response);
		}else{
			$this->response("false");
		}
	}
}
