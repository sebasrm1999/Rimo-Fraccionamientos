<?php
class BackEnd extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model("BackEnd_model");
    }

    public function index(){

    }

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
}
?>