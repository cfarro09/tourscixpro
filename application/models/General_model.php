<?php
class General_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
    function cronfestividad(){
    	$sql="update festividad SET 
fecha_fest = DATE_ADD(fecha_fest, INTERVAL IF(STRCMP(concurrencia, 'Mensual') = 0, 1, 0) month),
fecha_fest = DATE_ADD(fecha_fest, INTERVAL IF(STRCMP(concurrencia, 'Anual') = 0, 1, 0) year),
estado = 'I'
where (concurrencia = 'Mensual' or concurrencia = 'Anual') and fecha_fest < now()";
        $query = $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                "success" => true,
                "msg" => "Se editó satisfactoriamente."
            );
        }else{
            $response = array(
                "success" => false,
                "msg" => "Hubo un problema, vuelva a intentarlo."
            );
        }
        // var_dump($this->db->error()); die;
        return $response;
    }
	//GET COLUMN'S NAME OF USUARIOS AND DATA
    function get_columns_name($name_table){
    	$sql=" SHOW FULL COLUMNS FROM " . $name_table . ";";
	    $query = $this->db->query($sql);
	    $result = $query->num_rows() >= 1 ? $query->result() : false;
	    return $result;
    }
    function get_columns_only_name($name_table){
    	$sql="Describe " . $name_table . ";";
	    $query = $this->db->query($sql);
	    $result = $query->num_rows() >= 1 ? $query->result() : false;
	    return $result;
    }
    
    function get_data_dynamic($table, $select, $foranea = false, $where = false, $limit = false) {
        $this->db->select($select);
        if ($foranea) {
            foreach ($foranea as $fk) {
                $this->db->join($fk['tablefk'] ,$fk['comp'], 'LEFT');
            }
        }
        if ($limit) {
            $this->db->limit(3); 
        }
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        // var_dump($this->db->last_query());die;
        return ($query->num_rows() >= 1) ? $query->result() : false;
    }
    function insert_dynamic($name_table, $data){
        $this->db->insert($name_table,$data);
        // var_dump($this->db->error()); die;
        if ($this->db->affected_rows() > 0) {
            $response = array(
                "success" => true,
                "msg" => "Se registró satisfactoriamente."
            );
        }else{
            $response = array(
                "success" => false,
                "msg" => "Hubo un problema, vuelva."
            );
        }
        return $response;
    }
    function delete_dynamic($name_table, $where){
        if (!$this->db->delete($name_table, $where)) {
            
            if ($error['code']==1451) {
                $response = array(
                    "success" => false,
                    "msg" => "El registro que está intentando eliminar está siendo usado por otra tabla. Elimine aquel registro y despues intente eliminar el actual registro."
                );
            }else{
                $response = array(
                    "success" => false,
                    "msg" => "Error desconocido, vuelva a intentarlo."
                );
            }
        }else{
            if ($this->db->affected_rows() > 0) {
                $response = array(
                    "success" => true,
                    "msg" => "Se eliminó satisfactoriamente."
                );
            }else{
                $response = array(
                    "success" => false,
                    "msg" => $this->db->error()
                );
            }
        }
        return $response;
    }
    function get_data_id_dynamic($name_table, $where){
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get($name_table);
        return ($query->num_rows() >= 1) ? $query->result() : false;
    }
    function update_dynamic($name_table, $where, $data){
        $this->db->where($where);
        
        
        foreach ($data as $column => $value) {
            $this->db->set($column, $value, FALSE);        
        }
        
        $this->db->update($name_table);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                "success" => true,
                "msg" => "Se editó satisfactoriamente."
            );
        }else{
            $response = array(
                "success" => false,
                "msg" => "Hubo un problema, vuelva a intentarlo."
            );
        }
        // var_dump($this->db->error()); die;
        return $response;
    }
    function edit_dynamic($name_table, $where, $data){
        $this->db->where($where);
        $this->db->update($name_table, $data);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                "success" => true,
                "msg" => "Se editó satisfactoriamente."
            );
        }else{
            $response = array(
                "success" => false,
                "msg" => "Hubo un problema, vuelva a intentarlo."
            );
        }
        // var_dump($this->db->error()); die;
        return $response;
    }
    function get_tables_active(){
        $this->db->select("*");
        $this->db->where(["statusTable" => "AC"]);
        $query = $this->db->get("adminpro_dynamic");
        return ($query->num_rows() >= 1) ? $query->result() : false;
    }
    function get_tipos_documento(){
        $this->db->select("*");
        $query = $this->db->get("Tipos_documentos");
        return ($query->num_rows() >= 1) ? $query->result() : false;
    }
    function insert_dynamic_array_($nametable, $array) {
        $this->db->insert_batch($nametable, $array);
        // var_dump($this->db->last_query());die;
		if ($this->db->affected_rows() > 0) {
			$response = array(
				"success" => true,
				"msg" => "Se registró con exito!"
			);
		}else{
			$response = array(
				"success" => false,
				"msg" => "Hubo un problema, vuelva intentarlo."
			);
		}
		return $response;
	}
    function get_menu_dynamic(){
        $tipo_usu = $this->session->userdata('tipo_usu');
        if ($tipo_usu == "AD" || $tipo_usu == "SA" ) {
            $menu_tables  = json_decode($this->session->userdata('menu_tables'));
        }else{
            $this->load->model('Permisos_model');
            $menu_tables = $this->Permisos_model->get_permisos_type_user($tipo_usu);
        }
        return $menu_tables;
    }
}
