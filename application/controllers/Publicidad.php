<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publicidad extends CI_Controller
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
        $data['pub'] = $this->General_model->get_data_dynamic('publicidad', "*");
        $this->layout->view('publicidad/index');
    }
    public function loadimage()
	{
		$directorio = "./imagenes/";
		$fecha = date('YmdH_i_s');
		$rutafoto = "";
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = $fecha . '.png';
		file_put_contents($directorio . $imageName, $data);
		$rutafoto = base_url() . 'imagenes/' . $imageName;
		echo json_encode(array('rutafoto' => $rutafoto));
	}
}
