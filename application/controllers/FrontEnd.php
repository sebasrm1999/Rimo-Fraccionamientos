<?php
class FrontEnd extends CI_Controller{
    public function __construct(){
		parent::__construct();
		$this->load->helper('url');
    }
    
    public function index(){
        $this->load->view('login_view');
    }

    public function inicio(){
		
      $this->load->view('inicio_view');
  
    }

    public function pagos(){
		
      $this->load->view('pagos_view');
  
    }

    public function quejas(){
		
      $this->load->view('quejas_view');
  
    }

    public function preguntas(){
		
      $this->load->view('preguntas-view');
  
    }

    public function registro(){
		
      $this->load->view('registro_view');
  
    }

    public function avisoscrud(){
		
      $this->load->view('avisosCrud_view');
  
    }

    public function pagoscrud(){
		
      $this->load->view('pagosCrud_view');
  
    }

    public function quejascrud(){
		
      $this->load->view('quejasCrud_view');
  
    }
}
?>