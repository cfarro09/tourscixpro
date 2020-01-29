<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lugar_turistico extends CI_Controller
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
    public function register()
    {
        $data['menu_tables'] = $this->General_model->get_menu_dynamic();

        $this->layout->view('lugar_turistico/register', $data);
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
        $res_max = $this->General_model->get_data_dynamic('lugar_turisticoaux', "max(codUpdate) as max");
        $maxCode = $res_max[0]->max + 1;
        $data['codUpdate'] = $maxCode;
        //codigo actualizacion
        $data['id_usu'] = $this->session->userdata('id_usu');
        $response = $this->General_model->insert_dynamic('lugar_turisticoaux', $data);
        
        echo json_encode($response);
    }
    public function listar()
    {
        $data['menu_tables'] = $this->General_model->get_menu_dynamic();
        $data['lugares'] = $this->General_model->get_data_dynamic('lugar_turisticoaux', "*");
        $this->layout->view('lugar_turistico/listar', $data);
    }
    public function editar($cod_lugar = false)
    {
        $data['menu_tables'] = $this->General_model->get_menu_dynamic();

        if ($cod_lugar || ($this->session->userdata('tipo_usu') == "SA" && $this->session->userdata('tipo_usu') == "AD")) {
            $data['lugar'] = $this->General_model->get_data_id_dynamic('lugar_turisticoaux',array('cod_lugar' => $cod_lugar));
            if ($data['lugar']) {
                $data['lugar'] = $data['lugar'][0];
                $data['list_fotos'] = $this->General_model->get_data_id_dynamic(
                    'foto_atractivo',
                    array('cod_lugar' => $cod_lugar)
                );
                $data['cod_lugar'] = $cod_lugar;
                $this->layout->view('lugar_turistico/editar', $data);
            } else {
                redirect('lugar_turistico/listar', "refresh");
            }
        } else {
            redirect('/', "refresh");
        }
    }
    public function delete_listar()
    {
        $cod_lugar = html_purify($this->input->post('cod_lugar'));
        if ($cod_lugar) {
            $data['estado'] = "I";
            //codigo actualizacion
            $res_max = $this->General_model->get_data_dynamic('festividad', "max(codUpdate) as max");
            $maxCode = $res_max[0]->max + 1;
            $data['codUpdate'] = $maxCode;
            //codigo actualizacion
            $response = $this->General_model->edit_dynamic('lugar_turisticoaux', array("cod_lugar" => $cod_lugar), $data);
            echo json_encode($response);
        } else {
            echo json_encode('false');
        }
    }
    public function editar_lugar()
    {
        $data = html_purify($this->input->post());
        $cod_lugar = $data['cod_lugar'];
        unset($data['cod_lugar']);
        //codigo actualizacion
        $res_max = $this->General_model->get_data_dynamic('lugar_turisticoaux', "max(codUpdate) as max");
        $maxCode = $res_max[0]->max + 1;
        $data['codUpdate'] = $maxCode;
        //codigo actualizacion
        $where = array("cod_lugar" => $cod_lugar);
        $response = $this->General_model->edit_dynamic('lugar_turisticoaux', $where, $data);
        echo json_encode($response);
    }
}
