<?php
class BackEnd_model extends CI_Model{

    public function __construct(){
		parent::__construct();
    }

    //AREAS
    
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

    //PREGUNTAS

    public function inserta_pregunta($data){
        $this->db->insert('pregunta', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_pregunta($data){
        $this->db->where('id_pregunta', $data['id_pregunta']);
        $this->db->update('pregunta', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_preguntas(){
        $rs = $this->db->get("pregunta");
        $obj['preguntas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_pregunta($id){
        $this->db->where('id_pregunta', $id);
        $rs = $this->db->get("pregunta");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_pregunta($id){
        $this->db->where('id_pregunta', $id);
        $this->db->delete('pregunta');

        $this->db->where('id_pregunta', $id);
        $rs = $this->db->get('pregunta');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

    //USUARIOS

    public function inserta_usuario($data){
        $this->db->insert('usuario', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_usuario($data){
        $this->db->where('id_usuario', $data['id_usuario']);
        $this->db->update('usuario', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_usuarios(){
        $this->db->where('tipo', 1);
        $rs = $this->db->get("usuario");
        $obj['usuarios'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_usuario($id){
        $this->db->where('id_usuario', $id);
        $rs = $this->db->get("usuario");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_usuario($id){
        $this->db->where('id_usuario', $id);
        $this->db->delete('usuario');

        $this->db->where('id_usuario', $id);
        $rs = $this->db->get('usuario');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

    //AVISOS

    public function inserta_aviso($data){
        $this->db->insert('aviso', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_aviso($data){
        $this->db->where('id_aviso', $data['id_aviso']);
        $this->db->update('aviso', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_avisos(){
        $rs = $this->db->get("aviso");
        $obj['avisos'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_aviso($id){
        $this->db->where('id_aviso', $id);
        $rs = $this->db->get("aviso");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_aviso($id){
        $this->db->where('id_aviso', $id);
        $this->db->delete('aviso');

        $this->db->where('id_aviso', $id);
        $rs = $this->db->get('aviso');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

    //PAGOS

    public function inserta_pago($data){
        $this->db->insert('pago', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_pago($data){
        $this->db->where('id_pago', $data['id_pago']);
        $this->db->update('pago', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_pagos(){
        $query = "SELECT pago.*,usuario.nombre from pago, usuario WHERE pago.id_usuario=usuario.id_usuario";
        $rs = $this->db->query($query);
        $obj['pagos'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_pago($id){
        $query = "SELECT pago.*, usuario.nombre from pago, usuario WHERE pago.id_usuario=usuario.id_usuario AND id_pago=".$id."";
        $rs = $this->db->query($query);
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_pago($id){
        $this->db->where('id_pago', $id);
        $this->db->delete('pago');

        $this->db->where('id_pago', $id);
        $rs = $this->db->get('pago');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

    //QUEJAS

    public function inserta_queja($data){
        $this->db->insert('queja', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_queja($data){
        $this->db->where('id_queja', $data['id_queja']);
        $this->db->update('queja', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_quejas(){
        $rs = $this->db->get("queja");
        $obj['quejas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_queja($id){
        $this->db->where('id_queja', $id);
        $rs = $this->db->get("queja");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_queja($id){
        $this->db->where('id_queja', $id);
        $this->db->delete('queja');

        $this->db->where('id_queja', $id);
        $rs = $this->db->get('queja');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

    //COMENTARIOS

    public function inserta_comentario($data){
        $this->db->insert('comentario', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_comentario($data){
        $this->db->where('id_comentario', $data['id_comentario']);
        $this->db->update('comentario', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_comentarios(){
        $rs = $this->db->get("comentario");
        $obj['comentarios'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_comentario($id){
        $this->db->where('id_comentario', $id);
        $rs = $this->db->get("comentario");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_comentario($id){
        $this->db->where('id_comentario', $id);
        $this->db->delete('comentario');

        $this->db->where('id_comentario', $id);
        $rs = $this->db->get('comentario');

        $obj["resultado"] = $rs->num_rows() == 0 ? TRUE : FALSE;

        return $obj;
    }

    //LOGIN

    public function login_usuario($correo, $password){
        $this->db->where('correo', $correo);
        $this->db->where('contrasenia', $password);
        $rs = $this->db->get("usuario");
        $obj['resultado'] = $rs->num_rows() > 0;
        $obj['usuario'] = $obj['resultado'] ? $rs->result() : NULL; 

		return $obj;
    }

}
?>