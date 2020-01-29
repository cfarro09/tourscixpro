<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Festividad extends CI_Controller
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
        // $this->load->library('form_validation');
    }
    public function register()
    {
        $this->layout->view('festividad/register');
    }
    public function get_provincias()
    {
        $departamento = html_purify($this->input->post('departamento'));
        $where = array('d.departamento' => $departamento);
        $foranea[0] = array(
            "tablefk" => "ubdepartamento d",
            "comp" => "d.idDepa = p.idDepa"
        );
        $response = $this->General_model->get_data_dynamic('ubprovincia p', "p.provincia", $foranea, $where);
        echo json_encode($response);
    }
    public function insert_lugar()
    {
        $data = html_purify($this->input->post());
        if ($this->session->userdata('tipo_usu') != "SA" && $this->session->userdata('tipo_usu') != "AD") {
            $data['estado'] = "I";
        }
        //codigo actualizacion
        $res_max = $this->General_model->get_data_dynamic('festividad', "max(codUpdate) as max");
        $maxCode = $res_max[0]->max + 1;
        $data['codUpdate'] = $maxCode;
        //codigo actualizacion
        $data['usuario'] = $this->session->userdata('id_usu');
        $response = $this->General_model->insert_dynamic('festividad', $data);
        echo json_encode($response);
    }
    public function listar()
    {
        $data['lugares'] = $this->General_model->get_data_dynamic('festividad', "*");
        $this->layout->view('festividad/listar', $data);
    }
    public function editar($cod_fest = false)
    {
        if ($cod_fest || ($this->session->userdata('tipo_usu') == "SA" && $this->session->userdata('tipo_usu') == "AD")) {
            $data['festividad'] = $this->General_model->get_data_id_dynamic('festividad', array('cod_fest' => $cod_fest)
        );
            if ($data['festividad']) {
                $data['festividad'] = $data['festividad'][0];
                $data['list_fotos'] = $this->General_model->get_data_id_dynamic(
                    'foto_fest',
                    array('cod_fest' => $cod_fest)
                );
                $data['cod_fest'] = $cod_fest;
                // var_dump($data); die;
                $this->layout->view('festividad/editar', $data);
            } else {
                redirect('festividad/listar', "refresh");
            }
        } else {
            redirect('/', "refresh");
        }
    }
    public function delete_listar()
    {
        $cod_fest = html_purify($this->input->post('cod_fest'));
        if ($cod_fest) {
            //codigo actualizacion
            $res_max = $this->General_model->get_data_dynamic('festividad', "max(codUpdate) as max");
            $maxCode = $res_max[0]->max + 1;
            $data['codUpdate'] = $maxCode;
            //codigo actualizacion
            $data['estado'] = "I";
            $response = $this->General_model->edit_dynamic('festividad', array("cod_lugar" => $cod_lugar), $data);
            echo json_encode($response);

        } else {
            echo json_encode('false');
        }
    }
    public function editar_festividad()
    {
        $data = html_purify($this->input->post());
        $cod_fest = $data['cod_fest'];
        unset($data['cod_fest']);
        //codigo actualizacion
        $res_max = $this->General_model->get_data_dynamic('festividad', "max(codUpdate) as max");
        $maxCode = $res_max[0]->max + 1;
        $data['codUpdate'] = $maxCode;
        //codigo actualizacion
        $where = array("cod_fest" => $cod_fest);
        $response = $this->General_model->edit_dynamic('festividad', $where, $data);
        echo json_encode($response);
    }
    
}
