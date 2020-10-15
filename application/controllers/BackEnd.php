<?php
class BackEnd extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model("BackEnd_model");
    }

    public function index(){

    }

    //AREAS

    public function nuevaarea(){
        $nombre    = $this->input->post( "nombre" ); 
        $encargado      = $this->input->post( "encargado" );

        $data = array(
            'id_area' => 0,
            'nombre' => $nombre,
            'encargado' => $encargado
        );

        $obj = $this->BackEnd_model->inserta_area($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function areas(){
        $obj = $this->BackEnd_model->get_area();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizaarea(){
        $id    = $this->input->post( "id" );
        $nombre    = $this->input->post( "nombre" ); 
        $encargado      = $this->input->post( "encargado" );

        $data = array(
            'id_area' => $id,
            'nombre' => $nombre,
            'encargado' => $encargado
        );

        $obj = $this->BackEnd_model->update_area($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borraarea(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_area($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //PREGUNTAS

    public function nuevapregunta(){
        $asunto    = $this->input->post( "asunto" ); 
        $desc      = $this->input->post( "descripcion" );

        $data = array(
            'id_pregunta' => 0,
            'asunto' => $asunto,
            'descripcion' => $desc
        );

        $obj = $this->BackEnd_model->inserta_pregunta($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function preguntas(){
        $obj = $this->BackEnd_model->get_preguntas();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function pregunta(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_pregunta($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizapregunta(){
        $id    = $this->input->post( "id" );
        $asunto    = $this->input->post( "asunto" ); 
        $descripcion      = $this->input->post( "descripcion" );

        $data = array(
            'id_pregunta' => $id,
            'asunto' => $asunto,
            'descripcion' => $descripcion
        );

        $obj = $this->BackEnd_model->update_pregunta($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borrapregunta(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_pregunta($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //USUARIOS

    public function nuevousuario(){
        $nombre    = $this->input->post( "nombre" ); 
        $duenio      = $this->input->post( "duenio" );
        $correo    = $this->input->post( "correo" ); 
        $contrasenia      = $this->input->post( "contrasenia" );
        $telefono    = $this->input->post( "telefono" ); 
        $direccion      = $this->input->post( "direccion" );

        $data = array(
            'id_usuario' => 0,
            'nombre' => $nombre,
            'duenio' => $duenio,
            'tipo' => 1,
            'correo' => $correo,
            'contrasenia' => $contrasenia,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'verificado' => 0,
        );

        $obj = $this->BackEnd_model->inserta_usuario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function usuarios(){
        $obj = $this->BackEnd_model->get_usuarios();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function usuario(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_usuario($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizausuario(){
        $id    = $this->input->post( "id" ); 
        $nombre    = $this->input->post( "nombre" ); 
        $duenio      = $this->input->post( "duenio" );
        $correo    = $this->input->post( "correo" ); 
        $contrasenia      = $this->input->post( "contrasenia" );
        $telefono    = $this->input->post( "telefono" ); 
        $direccion      = $this->input->post( "direccion" );
        $verificado      = $this->input->post( "verificado" );

        $data = array(
            'id_usuario' => $id,
            'nombre' => $nombre,
            'duenio' => $duenio,
            'correo' => $correo,
            'contrasenia' => $contrasenia,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'verificado' => $verificado,
        );

        $obj = $this->BackEnd_model->update_usuario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borrausuario(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_usuario($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //AVISOS

    public function nuevoaviso(){
        $tipo    = $this->input->post( "tipo" ); 
        $asunto      = $this->input->post( "asunto" );
        $desc    = $this->input->post( "descripcion" ); 
        $fecha      = date("Y-m-d");
        $hora    = date("H:i:s");

        if($tipo == 2){
            $idusu    = $this->input->post( "id_usuario" );

            $usuarioExiste = $this->BackEnd_model->get_usuario($idusu);

            if($usuarioExiste != NULL){
                $data = array(
                    'id_aviso' => 0,
                    'tipo' => $tipo,
                    'id_usuario' => $idusu,
                    'status' => 0,
                    'asunto' => $asunto,
                    'descripcion' => $desc,
                    'fecha' => $fecha,
                    'hora' => $hora
                    ); 
        
                    $obj = $this->BackEnd_model->inserta_aviso($data);
        
                    $this->output->set_content_type( "application/json" );
                    echo json_encode( $obj );
            } else {
                $obj['resultado'] = false;
                $obj['mensaje'] = 'El usuario ingresado no existe.';

                $this->output->set_content_type( "application/json" );
                echo json_encode( $obj );
            }

        } else if($tipo == 1){

            $data = array(
            'id_aviso' => 0,
            'tipo' => $tipo,
            'status' => 0,
            'asunto' => $asunto,
            'descripcion' => $desc,
            'fecha' => $fecha,
            'hora' => $hora
            ); 

            $obj = $this->BackEnd_model->inserta_aviso($data);

            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        } else {
            $obj['mensaje'] = 'Tipo inválido';

            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }

        
    }

    public function avisos(){
        $obj = $this->BackEnd_model->get_avisos();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function aviso(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_aviso($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizaaviso(){
        $id    = $this->input->post( "id" );
        $asunto      = $this->input->post( "asunto" );
        $desc    = $this->input->post( "descripcion" );
        $status    = $this->input->post( "status" );
        $tipo    = $this->input->post( "tipo" );
        
        if($tipo == 2){
            $idusu    = $this->input->post( "id_usuario" );

            $usuarioExiste = $this->BackEnd_model->get_usuario($idusu);

            if($usuarioExiste != NULL){
                $data = array(
                    'id_aviso' => $id,
                    'status' => $status,
                    'asunto' => $asunto,
                    'descripcion' => $desc,
                    'tipo' => $tipo,
                    'id_usuario' => $idusu
                    ); 
        
                $obj = $this->BackEnd_model->update_aviso($data);
        
                $this->output->set_content_type( "application/json" );
                echo json_encode( $obj );
            } else {
                $obj['resultado'] = false;
                $obj['mensaje'] = 'El usuario ingresado no existe.';

                $this->output->set_content_type( "application/json" );
                echo json_encode( $obj );
            }

        } else if($tipo == 1){

            $data = array(
                'id_aviso' => $id,
                'status' => $status,
                'asunto' => $asunto,
                'descripcion' => $desc,
                'tipo' => $tipo
                ); 
    
            $obj = $this->BackEnd_model->update_aviso($data);
    
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        } else {
            $obj['mensaje'] = 'Tipo inválido';

            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }

        
    }

    public function borraaviso(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_aviso($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //PAGOS

    public function nuevopago(){
        $id    = $this->input->post( "id_usuario" ); 
        $mes      = $this->input->post( "mes" );
        $anio    = $this->input->post( "anio" );

        $data = array(
            'id_pago' => 0,
            'id_usuario' => $id,
            'mes' => $mes,
            'anio' => $anio
        );

        $obj = $this->BackEnd_model->inserta_pago($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizapago(){
        $id    = $this->input->post( "id" );
        $idusu      = $this->input->post( "id_usuario" );
        $mes    = $this->input->post( "mes" );
        $anio    = $this->input->post( "anio" );
        $fecha    = $this->input->post( "fecha" );
        $hora    = $this->input->post( "hora" );
        $pronto    = $this->input->post( "pronto" );
        $status    = $this->input->post( "status" );
        $tipo    = $this->input->post( "tipo" );

        $data = array(
            'id_pago' => $id,
            'fecha' => $fecha,
            'hora' => $hora,
            'id_usuario' => $idusu,
            'mes' => $mes,
            'anio' => $anio,
            'pronto' => $pronto,
            'status' => $status,
            'tipo' => $tipo,
            ); 

        $obj = $this->BackEnd_model->update_pago($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function pagos(){
        $obj = $this->BackEnd_model->get_pagos();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function pago(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_pago($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borrapago(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_pago($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //QUEJAS

    public function nuevaqueja(){
        $asunto    = $this->input->post( "asunto" ); 
        $desc      = $this->input->post( "descripcion" );
        $idarea    = $this->input->post( "id_area" );
        $fecha      = date("Y-m-d");
        $hora    = date("H:i:s");
        $idusu    = $this->input->post( "id_usuario" );

        $data = array(
            'id_queja' => 0,
            'asunto' => $asunto,
            'descripcion' => $desc,
            'id_area' => $idarea,
            'fecha' => $fecha,
            'hora' => $hora,
            'id_usuario' => $idusu,
        );

        $obj = $this->BackEnd_model->inserta_queja($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function quejas(){
        $obj = $this->BackEnd_model->get_quejas();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function queja(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_queja($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizaqueja(){
        $id    = $this->input->post( "id" );
        $idusu      = $this->input->post( "id_usuario" );
        $asunto    = $this->input->post( "asunto" );
        $descripcion    = $this->input->post( "descripcion" );
        $fecha    = $this->input->post( "fecha" );
        $hora    = $this->input->post( "hora" );
        $idarea    = $this->input->post( "id_area" );
        $status    = $this->input->post( "status" );

        $data = array(
            'id_queja' => $id,
            'fecha' => $fecha,
            'hora' => $hora,
            'id_usuario' => $idusu,
            'asunto' => $asunto,
            'descripcion' => $descripcion,
            'id_area' => $idarea,
            'status' => $status,
            ); 

        $obj = $this->BackEnd_model->update_queja($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borraqueja(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_queja($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //COMENTARIOS

    public function nuevocomentario(){
        $idusu    = $this->input->post( "id_usuario" ); 
        $texto      = $this->input->post( "texto" );
        $idqueja    = $this->input->post( "id_queja" );
        $fecha      = date("Y-m-d");
        $hora    = date("H:i:s");

        $data = array(
            'id_comentario' => 0,
            'id_usuario' => $idusu,
            'texto' => $texto,
            'fecha' => $fecha,
            'hora' => $hora,
            'id_queja' => $idqueja,
        );

        $obj = $this->BackEnd_model->inserta_comentario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function comentarios(){
        $obj = $this->BackEnd_model->get_comentarios();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function comentario(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_comentario($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizacomentario(){
        $id    = $this->input->post( "id" );
        $idusu      = $this->input->post( "id_usuario" );
        $texto    = $this->input->post( "texto" );
        $fecha    = $this->input->post( "fecha" );
        $hora    = $this->input->post( "hora" );
        $idqueja    = $this->input->post( "id_queja" );

        $data = array(
            'id_comentario' => $id,
            'fecha' => $fecha,
            'hora' => $hora,
            'id_usuario' => $idusu,
            'texto' => $texto,
            'id_queja' => $idqueja
            ); 

        $obj = $this->BackEnd_model->update_comentario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borracomentario(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_comentario($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    //LOGIN

    public function login(){
        $correo    = $this->input->post( "correo" );
        $password    = $this->input->post( "contrasenia" ); 
        $obj = $this->BackEnd_model->login_usuario($correo, $password);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

}
?>