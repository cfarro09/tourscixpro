<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AvisoPub extends CI_Controller
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
        $response = $this->General_model->insert_dynamic('aviso', $data);
        echo json_encode($response);
    }
    public function getlist()
    {
        $data = $this->General_model->get_data_dynamic('aviso', "*");
        echo json_encode($data);
    }
}
