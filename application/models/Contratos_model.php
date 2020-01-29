<?php
class Contratos_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
    function get_personal_last_contr() {
        $this->db->select("p.idpers, p.nombres, p.nro_doc, c.end_cont");
        $this->db->where("c.end_cont in (select max(c.end_cont ) from Contratos)");
        $this->db->join("Contratos c","idpers", 'LEFT');
        $query = $this->db->get("Personal p");
        return ($query->num_rows() >= 1) ? $query->result() : false;
    }
}
