<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Foto_fest extends CI_Controller
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
        $data['festividades'] = $this->General_model->get_data_dynamic('festividad', "cod_fest, nombre_fest");
        $this->layout->view('foto_fest/register', $data);
    }
    public function insert_foto_fest()
    {
        $cod_fest = html_purify($this->input->post('cod_fest'));
        $response_1 = $this->General_model->get_data_dynamic('foto_fest', "count(cod_foto) as count, max(cod_foto) as max", false, array("cod_fest" => $cod_fest));
        $max_code = (int)$response_1[0]->max;
        $count_fotos = (int)$response_1[0]->count;

        $directorio = "../imagenes/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }
        $fecha = date('Y-m-d H:i:s');
        $array_tosend = [];
        $success = false;
        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $count_fotos++;
            $max_code++;
            $foto_tosend = new stdClass();
            $ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            $archivo = $cod_fest . "_" . $count_fotos . "_" . $max_code . "." . $ext;
            $destino =  $directorio . $archivo;

            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $destino)) {
                $foto_tosend->name_foto = $archivo;
                $foto_tosend->cod_fest = $cod_fest;
                $foto_tosend->fecha = $fecha;
                
                $baseurlx = str_replace("http:", "https:", base_url());

                $foto_tosend->ruta_foto = $baseurlx . '../imagenes/' . $archivo;
                $success = true;
                array_push($array_tosend, $foto_tosend);
            }
            $dest = "../imagenes/thumbs/" . $archivo; // archivo de destino 

            $width_d = 300; // ancho de salida 
            $height_d = 200; // alto de salida 

            list($width_s, $height_s) = getimagesize($destino);
            list($width_s, $height_s, $type, $attr) = getimagesize($destino, $info2); // 
            if ($ext == "jpeg") $ext = "jpg";

            // Dependiendo de la extensi��n llamamos a distintas funciones
            ini_set('memory_limit', '-1');
            switch ($ext) {
                case "jpg":
                    $gd_s = imagecreatefromjpeg($destino);
                    break;
                case "png":
                    try {
                        $gd_s = imagecreatefrompng($destino);
                    } catch (Exception $e) {
                        var_dump($e->getMessage());
                        die;
                    }
                    break;
                case "gif":
                    $gd_s = imagecreatefromgif($destino);
                    break;
            }

            $gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida 

            imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona 
            imagejpeg($gd_d, $dest); // graba 
            // Se liberan recursos 
            imagedestroy($gd_s);
            imagedestroy($gd_d);
        }
        if ($success) {
            $response = $this->General_model->insert_dynamic_array_('foto_fest', $array_tosend);
            echo json_encode($response);
        } else {
            echo json_encode("false");
        }
    }
    public function listar()
    {
        $foranea[0] = array(
            "tablefk" => "festividad l",
            "comp" => "f.cod_fest = l.cod_fest"
        );
        $data['fotos_lugares'] = $this->General_model->get_data_dynamic('foto_fest f', "f.*, l.nombre_fest", $foranea);
        $this->layout->view('foto_fest/listar', $data);
    }
    public function editar($cod_foto = false)
    {
        if ($cod_foto || ($this->session->userdata('tipo_usu') == "SA" && $this->session->userdata('tipo_usu') == "AD")) {
            $data['festividades'] = $this->General_model->get_data_dynamic('festividad', "cod_fest, nombre_fest");
            if ($data['festividades']) {
                $data['foto_fest'] = $this->General_model->get_data_id_dynamic(
                    'foto_fest',
                    array('cod_foto' => $cod_foto)
                );
                $data['foto_fest'] = isset($data['foto_fest'][0]) ? $data['foto_fest'][0] : false;
                // var_dump($data); die;
                $this->layout->view('foto_fest/editar', $data);
            } else {
                redirect('foto_fest/listar', "refresh");
            }
        } else {
            redirect('/', "refresh");
        }
    }
    public function delete_foto_fest()
    {
        $cod_foto = html_purify($this->input->post('cod_foto'));
        $name_foto = html_purify($this->input->post('name_foto'));

        if ($cod_foto) {
            $response = $this->General_model->delete_dynamic('foto_fest', array("cod_foto" => $cod_foto));
            if (isset($response['success']) && $response['success']) {
                $img_big = $_SERVER['DOCUMENT_ROOT'] . "/imagenes/" . $name_foto;
                $img_thumbs = $_SERVER['DOCUMENT_ROOT'] . "/imagenes/thumbs" . str_replace(" ", "-", $name_foto);
                if (is_file($img_big)) {
                    unlink($img_big);
                }
                if (file_exists($img_thumbs)) {
                    unlink($img_big);
                }
            }
            echo json_encode($response);
        } else {
            echo json_encode('false');
        }
    }
    public function editar_foto_fest()
    {
        $name_foto = $this->input->post('name_foto');
        $cod_fest = $this->input->post('cod_fest');
        $cod_foto = $this->input->post('cod_foto');
        $data = array("cod_fest" => $cod_fest);
        $where = array("cod_foto" => $cod_foto);
        $response = $this->General_model->edit_dynamic('foto_fest', $where, $data);
        
        if ($_FILES['file']['name']) {
            $directorio = "../imagenes/";
            if (!is_dir($directorio)) {
                mkdir($directorio, 0755, true);
            }
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            $archivo = $name_foto;
            $destino =  $directorio . $archivo;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $destino)) {
                $response = array("success" => true, "msg" => "Se modificó satisfactoriamente");
            }
            $dest = "../imagenes/thumbs/" . $archivo; // archivo de destino 

            $width_d = 300; // ancho de salida 
            $height_d = 200; // alto de salida 

            list($width_s, $height_s) = getimagesize($destino);
            list($width_s, $height_s, $type, $attr) = getimagesize($destino, $info2); // 
            if ($ext == "jpeg") $ext = "jpg";

            // Dependiendo de la extensi��n llamamos a distintas funciones
            ini_set('memory_limit', '-1');
            switch ($ext) {
                case "jpg":
                    $gd_s = imagecreatefromjpeg($destino);
                    break;
                case "png":
                    try {
                        $gd_s = imagecreatefrompng($destino);
                    } catch (Exception $e) {
                        var_dump($e->getMessage());
                        die;
                    }
                    break;
                case "gif":
                    $gd_s = imagecreatefromgif($destino);
                    break;
            }

            $gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida 

            imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona 
            imagejpeg($gd_d, $dest); // graba 
            // Se liberan recursos 
            imagedestroy($gd_s);
            imagedestroy($gd_d);
        }
        echo json_encode($response);
    }
}
