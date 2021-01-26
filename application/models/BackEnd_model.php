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

    public function get_areas(){
        $rs = $this->db->get("area");
        $obj['areas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_area($id){
        $this->db->where('id_area', $id);
        $rs = $this->db->get("area");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

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

    //SUBCOLONIAS
    
    public function inserta_subcolonia($data){
        $this->db->insert('subcolonia', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_subcolonia($data){
        $this->db->where('id_subcolonia', $data['id_subcolonia']);
        $this->db->update('subcolonia', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function get_subcolonias(){
        $rs = $this->db->get("subcolonia");
        $obj['subcolonias'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_subcolonia($id){
        $this->db->where('id_subcolonia', $id);
        $rs = $this->db->get("subcolonia");
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function delete_subcolonia($id){
        $this->db->where('id_subcolonia', $id);
        $this->db->delete('subcolonia');

        $this->db->where('id_subcolonia', $id);
        $rs = $this->db->get('subcolonia');

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
        $this->db->or_where('tipo', 3);
        $this->db->order_by('fecha_registro', 'desc');
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

    public function get_usuariocorreo($correo){
        $this->db->where('correo', $correo);
        $rs = $this->db->get("usuario");
        $obj['resultado'] = $rs->num_rows() == 0 ? false : true;
        $obj['usuario'] = $obj['resultado'] == true ? $rs->result() : NULL; 
        $obj['mensaje'] = $obj['resultado'] == true ? 'Correo ya existente' : 'Correo no ha sido usado'; 

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
        $this->db->order_by('fecha', 'desc');
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

    public function get_avisopersonal($id){
        $this->db->where('id_usuario', $id);
        $this->db->order_by('fecha', 'desc');
        $rs = $this->db->get("aviso");
        $obj['avisos'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

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
        $obj['id'] = $this->db->insert_id();
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

    public function get_pagosusuario($id){
        $query = "SELECT pago.*,usuario.nombre from pago, usuario WHERE pago.id_usuario=usuario.id_usuario And pago.id_usuario=".$id." ";
        $rs = $this->db->query($query);
        $obj['pagos'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_pagoactual($id, $mes, $anio){
        $this->db->where('id_usuario', $id);
        $this->db->where('anio', $anio);
        $this->db->where('mes', $mes);
        $rs = $this->db->get("pago");
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
        $query = "SELECT queja.*,usuario.nombre from queja, usuario WHERE queja.id_usuario=usuario.id_usuario ORDER BY queja.fecha desc";
        $rs = $this->db->query($query);
        $obj['quejas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_queja($id){
        $query = "SELECT queja.*, usuario.nombre from queja, usuario WHERE queja.id_usuario=usuario.id_usuario AND id_queja=".$id."";
        $rs = $this->db->query($query);
        $obj = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_quejacomentarios($id){
        $query = "SELECT comentario.*, usuario.nombre from comentario, usuario WHERE comentario.id_usuario=usuario.id_usuario and id_queja=".$id."";
        $rs = $this->db->query($query);
        $obj['comentarios'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_quejausuario($id){
        $query = "SELECT queja.*, area.nombre from queja, area WHERE id_usuario=".$id." AND queja.id_area=area.id_area ORDER BY queja.fecha desc";
        $rs = $this->db->query($query);
        $obj['quejas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

		return $obj;
    }

    public function get_quejaarea($id){
        $query = "SELECT queja.*, usuario.nombre from queja, usuario WHERE queja.id_usuario=usuario.id_usuario AND queja.id_area=".$id." ORDER BY queja.fecha desc";
        $rs = $this->db->query($query);
        $obj['quejas'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 

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

    //PARAMETROS

    public function get_datos(){
        $rs = $this->db->get("datos");
        $obj['datos'] = $rs->num_rows() == 0 ? NULL : $rs->result(); 
        $obj['resultado'] = $obj['datos'] == NULL ? false : true;

		return $obj;
    }

    public function inserta_datos($data){
        $this->db->insert('datos', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }

    public function update_datos($data){
        $this->db->where('id_datos', $data['id_datos']);
        $this->db->update('datos', $data);
        $obj["resultado"] = $this->db->affected_rows() > 0;
        return $obj;
    }


}
?>