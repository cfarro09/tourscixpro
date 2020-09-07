<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Avisopub extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('html');
        $this->load->model('General_model');
        $this->load->library('layout', 'layout');
        if (!$this->session->userdata('id_usu')) { //isLogin
            redirect("login", "refresh");
        }
    }
    public function index()
    {
        $data['menu_tables'] = $this->General_model->get_menu_dynamic();
        $data['pub'] = $this->General_model->get_data_dynamic('aviso', "*");
        $this->layout->view('AvisoPub/index', $data);
    }
    public function loadimage()
	{
		$directorio = "../imagenes/";
		$fecha = date('YmdH_i_s');
		$rutafoto = "";
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = $fecha . '.png';
		file_put_contents($directorio . $imageName, $data);
		$rutafoto = base_url() . '../imagenes/' . $imageName;
		echo json_encode(array('rutafoto' => $rutafoto));
    }
    public function guardar()
    {
        $data = html_purify($this->input->post());
        $where = false;
        $id = html_purify($this->input->post("id"));
        if(isset($id) && $id){
            $where = array("id" => $id);
            unset($data['id']);
        }
        $response = $this->General_model->save_register_dynamic('aviso', $data, $where);
        echo json_encode($response);
    }
    public function getlist()
    {
        $id = html_purify($this->input->post("id"));
        $where = false;
        if(isset($id) && $id)
            $where = array("id" => $id);
        $data = $this->General_model->get_data_dynamic('aviso', "*", false, $where);
        echo json_encode($data, 256);
    }
    public function removerow()
    {
        $id = html_purify($this->input->post("id"));
        $response = $this->General_model->delete_dynamic('aviso', array("id" => $id));
        echo json_encode($response, 256);
    }
    public function selectad()
    {
        $id = html_purify($this->input->post("id"));
        $status = html_purify($this->input->post("status"));
        $status = $status == "false" ? false : true;
        if(!$status){
            $this->General_model->edit_dynamic('propiedades', array("llave" => "avisoid"), array("valor" => $id));
            $this->General_model->edit_dynamic('aviso', false, array("selected" => 0));
            $response = $this->General_model->edit_dynamic('aviso', array("id" => $id), array("selected" => 1));
        }else{
            $this->General_model->edit_dynamic('propiedades', array("llave" => "avisoid"), array("valor" => "0"));
            $response = $this->General_model->edit_dynamic('aviso', array("id" => $id), array("selected" => 0));
        }
        echo json_encode($response, 256);
    }
}
