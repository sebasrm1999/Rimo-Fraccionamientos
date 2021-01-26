<?php
class BackEnd extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        header('Access-Control-Allow-Origin: *');  
        header("Cache-Control: no-store,no-cache,must-revalidate;");
        header("Cache-Control: post-check=0,pre-check=0", FALSE);
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
        $obj = $this->BackEnd_model->get_areas();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function area(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_area($id);

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

    //SUBCOLONIAS

    public function nuevasubcolonia(){
        $nombre    = $this->input->post( "nombre" ); 

        $data = array(
            'id_subcolonia' => 0,
            'nombre' => $nombre
        );

        $obj = $this->BackEnd_model->inserta_subcolonia($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function subcolonias(){
        $obj = $this->BackEnd_model->get_subcolonias();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function subcolonia(){
        $id    = $this->input->post( "id" ); 
        $obj = $this->BackEnd_model->get_subcolonia($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizasubcolonia(){
        $id    = $this->input->post( "id" );
        $nombre    = $this->input->post( "nombre" );

        $data = array(
            'id_subcolonia' => $id,
            'nombre' => $nombre
        );

        $obj = $this->BackEnd_model->update_subcolonia($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function borrasubcolonia(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_subcolonia($id);

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
        $subcolonia      = $this->input->post( "subcolonia" );

        /*Buscamos la extensión del archivo*/
        $imagen_parts = explode(".", $_FILES['comprobante']['name']);
        $extension = end($imagen_parts); //png jpg jpeg gif svg
        $nombreGuiones = strtr($nombre, " ", "_");

        $comprobante      = strtolower($nombreGuiones).'.'.strtolower($extension);

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
            'comprobante' => $comprobante,
            'subcolonia' => $subcolonia
        );

	$destination_folder = '/home/ramseb188/public_html/myhome_ci/static/images/comprobantes/';
        /*Creamos el archivo en la carpeta correspondiente */
        $moved = move_uploaded_file($_FILES['comprobante']['tmp_name'], $destination_folder.''.$comprobante);

	if($moved){
			$obj = $this->BackEnd_model->inserta_usuario($data);

			if($obj['resultado'] === true){
            

			$this->output->set_content_type( "application/json" );
            		echo json_encode( $obj );

            
        		} else {
            			$obj['resultado'] = false;
				$obj['mensaje'] = 'Error al crear la cuenta';
            			$this->output->set_content_type( "application/json" );
            			echo json_encode( $obj );
        		}
			
		} else {
			$obj['resultado'] = false;
			$obj['mensaje'] = 'Error al subir el comprobante';
			$this->output->set_content_type( "application/json" );
            		echo json_encode( $obj );
		}
    }

    public function altausuario(){
        $nombre    = $this->input->post( "nombre" ); 
        $verificado      = $this->input->post( "verificado" );
        $tipo      = $this->input->post( "tipo" );
        $correo    = $this->input->post( "correo" ); 
        $contrasenia      = $this->input->post( "contrasenia" );
        $telefono    = $this->input->post( "telefono" ); 
        
        if($tipo == 1){
            $direccion      = $this->input->post( "direccion" );
            $subcolonia      = $this->input->post( "subcolonia" );
            $duenio      = $this->input->post( "duenio" );

            $data = array(
                'id_usuario' => 0,
                'nombre' => $nombre,
                'duenio' => $duenio,
                'tipo' => $tipo,
                'correo' => $correo,
                'contrasenia' => $contrasenia,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'verificado' => $verificado,
                'comprobante' => null,
                'subcolonia' => $subcolonia,
                'id_area' => null
            );
    
            $obj = $this->BackEnd_model->inserta_usuario($data);
    
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        } else if($tipo == 3){
            $area      = $this->input->post( "area" );

            $data = array(
                'id_usuario' => 0,
                'nombre' => $nombre,
                'duenio' => null,
                'tipo' => $tipo,
                'correo' => $correo,
                'contrasenia' => $contrasenia,
                'telefono' => $telefono,
                'direccion' => null,
                'verificado' => $verificado,
                'comprobante' => null,
                'subcolonia' => null,
                'id_area' => $area
            );
    
            $obj = $this->BackEnd_model->inserta_usuario($data);
    
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }

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

    public function verificarusuario(){
        $id    = $this->input->post( "id" ); 
        $data = array(
            'id_usuario' => $id,
            'verificado' => 1
        );

        $obj = $this->BackEnd_model->update_usuario($data);

        $usuario = $this->BackEnd_model->get_usuario($id);
        
        $destinatario = $usuario[0]->correo; 
        $asunto = "Su cuenta ha sido verificada"; 
        $cuerpo = ' 
        <html> 
        <head> 
        <title>¡Hola '.$usuario[0]->nombre.'!</title> 
        </head> 
        <body> 
        <h1>¡Hola '.$usuario[0]->nombre.'!</h1> 
        <p> 
        <b>Le informamos que su cuenta de myHome ha sido verificada con éxito y ya puede iniciar sesión tanto en la página como en la aplicación móvil. Gracias por la espera. Tenga un fabuloso día.
        </p> 
        </body> 
        </html> 
        '; 

        //cargamos la libreria email de ci
        $this->load->library("email");
        //            $this->load->model('producto/ProductoDaoImplements');
        //            $opProd = $this->ProductoDaoImplements->qryCorreoElectronico();
                    
        
        //configuracion para gmail
        $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'sebasrm69@gmail.com',
                'smtp_pass' => 'dinosaurio1999',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
        );    

        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);

        $this->email->from('sebasrm69@gmail.com','MyHome');
        $this->email->to($usuario[0]->correo);
        $this->email->subject('Su cuenta ha sido verificada');
        $this->email->message($cuerpo);
        //con esto podemos ver el resultado
        //var_dump($this->email->print_debugger());
        //$this->index();
        if($this->email->send()){
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        } else {
            $obj['resultado'] = false;
            $obj['mensaje'] = 'No se ha podido enviar el correo';
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }
    }

	public function obtenertoken(){
        $id    = $this->input->post( "id" ); 
        $token = bin2hex(openssl_random_pseudo_bytes((16 - (16 % 2)) / 2));
        $data = array(
            'id_usuario' => $id,
            'token' => $token
        );

        $obj = $this->BackEnd_model->update_usuario($data);

        $usuario = $this->BackEnd_model->get_usuario($id);
        
        $destinatario = $usuario[0]->correo; 
        $asunto = "Recuperación de contraseña"; 
        $cuerpo = ' 
        <html> 
        <head> 
        <title>¡Hola '.$usuario[0]->nombre.'!</title> 
        </head> 
        <body> 
        <h1>¡Hola '.$usuario[0]->nombre.'!</h1> 
        <p> 
        <b>De Click al siguiente botón para reestablecer su contraseña.
        </p>
        <a href="http://dtai.uteq.edu.mx/~ramseb188/myhome_ci/index.php/recuperar?token='.$token.'&id='.$usuario[0]->id_usuario.'" style="width: 247px; height: 51px; background: #adc867; color: #ffffff; border: none; outline: none; cursor: pointer; font-size: 14px; font-weight: 500; text-transform: uppercase;">
        Recuperar contraseña
        </a> 
        </body> 
        </html> 
        '; 

        //cargamos la libreria email de ci
        $this->load->library("email");
        //            $this->load->model('producto/ProductoDaoImplements');
        //            $opProd = $this->ProductoDaoImplements->qryCorreoElectronico();
                    
        
        //configuracion para gmail
        $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'sebasrm69@gmail.com',
                'smtp_pass' => 'dinosaurio1999',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
        );    

        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);

        $this->email->from('sebasrm69@gmail.com','MyHome');
        $this->email->to($usuario[0]->correo);
        $this->email->subject($asunto);
        $this->email->message($cuerpo);
        
        //con esto podemos ver el resultado
        //var_dump($this->email->print_debugger());
        //$this->index();
        if($this->email->send()){
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        } else {
            $obj['resultado'] = false;
            $obj['mensaje'] = 'No se ha podido enviar el correo';
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }
        
    }

    public function passwordusuario(){
        $id    = $this->input->post( "id" ); 
        $contra      = $this->input->post( "contrasenia" );
        $data = array(
            'id_usuario' => $id,
            'contrasenia' => $contra
        );

        $obj = $this->BackEnd_model->update_usuario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

	public function borrartoken(){
        $id    = $this->input->post( "id" ); 
        $data = array(
            'id_usuario' => $id,
            'token' => null
        );

        $obj = $this->BackEnd_model->update_usuario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function fechausuario(){
        $id    = $this->input->post( "id" ); 
        $fecha      = date("Y-m-d H:i:s");
        $data = array(
            'id_usuario' => $id,
            'fecha_pago' => $fecha
        );

        $obj = $this->BackEnd_model->update_usuario($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function usuariocorreo(){
        $correo    = $this->input->post( "correo" ); 
        $obj = $this->BackEnd_model->get_usuariocorreo($correo);

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

        if($contrasenia != null){
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
        } else {
            $data = array(
                'id_usuario' => $id,
                'nombre' => $nombre,
                'duenio' => $duenio,
                'correo' => $correo,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'verificado' => $verificado,
            );
    
            $obj = $this->BackEnd_model->update_usuario($data);
    
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }
       
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

    public function avisopersonal(){
        $idusuario    = $this->input->post( "id_usuario" ); 
        $obj = $this->BackEnd_model->get_avisopersonal($idusuario);

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

        $usuarioExiste = $this->BackEnd_model->get_usuario($id);

            if($usuarioExiste != NULL){
                $data = array(
                    'id_pago' => 0,
                    'id_usuario' => $id,
                    'mes' => $mes,
                    'anio' => $anio
                );
        
                $obj = $this->BackEnd_model->inserta_pago($data);
        
                $this->output->set_content_type( "application/json" );
                echo json_encode( $obj );
            } else {
                $obj['resultado'] = false;
                $obj['mensaje'] = 'El usuario ingresado no existe.';

                $this->output->set_content_type( "application/json" );
                echo json_encode( $obj );
            }

    }

    public function actualizapago(){
        $id    = $this->input->post( "id" );
        $idusu      = $this->input->post( "id_usuario" );
        $mes    = $this->input->post( "mes" );
        $anio    = $this->input->post( "anio" );
        $pronto    = $this->input->post( "pronto" );
        $status    = $this->input->post( "status" );
        $tipo    = $this->input->post( "tipo" );

        $usuarioExiste = $this->BackEnd_model->get_usuario($idusu);

            if($usuarioExiste != NULL){
                $data = array(
                    'id_pago' => $id,
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
            } else {
                $obj['resultado'] = false;
                $obj['mensaje'] = 'El usuario ingresado no existe.';

                $this->output->set_content_type( "application/json" );
                echo json_encode( $obj );
            }

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

    public function pagosxusuario(){
        $id    = $this->input->post( "id_usuario" ); 
        $obj = $this->BackEnd_model->get_pagosusuario($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function pagoactual(){
        $id    = $this->input->post( "id_usuario" ); 
        $mes    = $this->input->post( "mes" ); 
        $anio    = $this->input->post( "anio" ); 
        $obj = $this->BackEnd_model->get_pagoactual($id, $mes, $anio);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function verificarpago(){
        $id    = $this->input->post( "id" ); 
        $data = array(
            'id_pago' => $id,
            'verificado' => 1
        );

        $obj = $this->BackEnd_model->update_pago($data);


        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function pagar(){
        $idusu      = $this->input->post( "id_usuario" );
        $mes    = $this->input->post( "mes" );
        $anio    = $this->input->post( "anio" );
        $pronto    = $this->input->post( "pronto" );
        $tipo    = $this->input->post( "tipo" );
        $fecha      = date("Y-m-d");
        $hora    = date("H:i:s");
        $dia = date("d");
        
        if($dia > 5){
            $pronto = 0;
        } else {
            $pronto = 1;
        }
        $data = array(
            'id_pago' => 0,
            'id_usuario' => $idusu,
            'mes' => $mes,
            'anio' => $anio,
            'status' => 1,
            'tipo' => $tipo,
            'fecha' => $fecha,
            'hora' => $hora,
            'pronto' => $pronto
            ); 

        $obj = $this->BackEnd_model->inserta_pago($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );

    }

    public function borrapago(){
        $id    = $this->input->post( "id" );

        $obj = $this->BackEnd_model->delete_pago($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function subirticket(){
        $id     = $this->input->post( "id" );
        $idUsu     = $this->input->post( "id_usuario" );
        $mes    = $this->input->post( "mes" );
        $anio    = $this->input->post( "anio" );
        $pronto    = $this->input->post( "pronto" );
        $tipo    = $this->input->post( "tipo" );
        $fecha      = date("Y-m-d");
        $hora    = date("H:i:s");

        $nombre = $idUsu.' '.$mes.' '.$anio;

        /*Buscamos la extensión del archivo*/
        $imagen_parts = explode(".", $_FILES['comprobante']['name']);
        $extension = end($imagen_parts); //png jpg jpeg gif svg
        $nombreGuiones = strtr($nombre, " ", "_");

        $comprobante      = strtolower($nombreGuiones).'.'.strtolower($extension);

        $data = array(
            'id_pago' => $id,
            'pronto' => $pronto,
            'tipo' => $tipo,
            'status' => 1,
            'fecha' => $fecha,
            'hora' => $hora,
            'comprobante' => $comprobante
        );

	    $destination_folder = '/home/ramseb188/public_html/myhome_ci/static/images/tickets/';
        /*Creamos el archivo en la carpeta correspondiente */
        $moved = move_uploaded_file($_FILES['comprobante']['tmp_name'], $destination_folder.''.$comprobante);

	if($moved){
			$obj = $this->BackEnd_model->update_pago($data);

			if($obj['resultado'] === true){
            

			$this->output->set_content_type( "application/json" );
            		echo json_encode( $obj );

            
        		} else {
            			$obj['resultado'] = false;
				        $obj['mensaje'] = 'Error al cargar pago';
            			$this->output->set_content_type( "application/json" );
            			echo json_encode( $obj );
        		}
			
		} else {
			$obj['resultado'] = false;
			$obj['mensaje'] = 'Error al subir el comprobante';
			$this->output->set_content_type( "application/json" );
            		echo json_encode( $obj );
		}
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
        $asunto    = $this->input->post( "asunto" );
        $descripcion    = $this->input->post( "descripcion" );
        $idarea    = $this->input->post( "id_area" );
        $status    = $this->input->post( "status" );

        $data = array(
            'id_queja' => $id,
            'asunto' => $asunto,
            'descripcion' => $descripcion,
            'id_area' => $idarea,
            'status' => $status,
            ); 

        $obj = $this->BackEnd_model->update_queja($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function leerqueja(){
        $id    = $this->input->post( "id" );

        $data = array(
            'id_queja' => $id,
            'status' => 2
            ); 

        $obj = $this->BackEnd_model->update_queja($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function contestarqueja(){
        $id    = $this->input->post( "id" );

        $data = array(
            'id_queja' => $id,
            'status' => '3'
            ); 

        $obj = $this->BackEnd_model->update_queja($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function cerrarqueja(){
        $id    = $this->input->post( "id" );

        $data = array(
            'id_queja' => $id,
            'status' => '4'
            ); 

        $obj = $this->BackEnd_model->update_queja($data);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function fechaqueja(){
        $id    = $this->input->post( "id" );
        $fecha    = $this->input->post( "fecha" );

        $data = array(
            'id_queja' => $id,
            'fecha_estimada' => $fecha
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

    public function comentariosxqueja(){
        $id    = $this->input->post( "id" ); 
        $obj['queja'] = $this->BackEnd_model->get_queja($id);

        $obj += $this->BackEnd_model->get_quejacomentarios($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function quejaxusuario(){
        $id    = $this->input->post( "id_usuario" ); 
        $obj = $this->BackEnd_model->get_quejausuario($id);

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function quejaxarea(){
        $id    = $this->input->post( "id_area" ); 
        $obj = $this->BackEnd_model->get_quejaarea($id);

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
        $texto    = $this->input->post( "texto" );

        $data = array(
            'id_comentario' => $id,
            'texto' => $texto
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

    //PARAMETROS

    public function datos(){
        $obj = $this->BackEnd_model->get_datos();

        $this->output->set_content_type( "application/json" );
        echo json_encode( $obj );
    }

    public function actualizadatos(){
        $dias    = $this->input->post( "dias" ); 
        $costo      = $this->input->post( "costo" );
        $costoPronto    = $this->input->post( "costo_pronto" );
        $banco      = $this->input->post( "banco" );
        $numero    = $this->input->post( "numero" );
        $clabe    = $this->input->post( "clabe" );

        $datos = $this->BackEnd_model->get_datos();

        if($datos['resultado']){

            $id    = $this->input->post( "id" );

            $data = array(
                'id_datos' => $id,
                'dias' => $dias,
                'costo' => $costo,
                'costo_pronto' => $costoPronto,
                'banco' => $banco,
                'numero' => $numero,
                'clabe' => $clabe
            );
    
            $obj = $this->BackEnd_model->update_datos($data);
    
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );

        } else {
            $data = array(
                'id_datos' => 0,
                'dias' => $dias,
                'costo' => $costo,
                'costo_pronto' => $costoPronto,
                'banco' => $banco,
                'numero' => $numero,
                'clabe' => $clabe
            );
    
            $obj = $this->BackEnd_model->inserta_datos($data);
    
            $this->output->set_content_type( "application/json" );
            echo json_encode( $obj );
        }

    }

}
?>