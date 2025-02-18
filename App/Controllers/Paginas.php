<?php
require_once '../App/Libraries/Controller.php';

class Paginas extends Controller{
    public function index(){
      if(Sessao::estaLogado()):
        $this->view('pagina/home');
      else:
        $this->view('pagina/home');
      endif;
    }

    public function creatina(){
     $this->view('pagina/creatina');
    }

    public function pretreino(){
      $this->view('pagina/pretreino');
     }

     public function whey(){
      $this->view('pagina/whey');
     }

     public function barraproteica(){
      $this->view('pagina/barraproteica');
     }
}//fim da classe Paginas

?>