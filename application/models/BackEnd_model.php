<?php
class BackEnd_model extends CI_Model{

    public function __construct(){
		parent::__construct();
    }
    
    public function inserta_area($data){
        $this->db->insert('area', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_area($data){
        $this->db->where('id_area', $data['id_area']);
        $this->db->update('area', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_area(){
        $rs = $this->db->get("area");
        $obj['areas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_area($id){
        $this->db->where('id_area', $id);
        $this->db->delete('area');

        $this->db->where('id_area', $id);
        $rs = $this->db->get('area');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

}
?>