<?php

namespace App\Controllers;

class Inicio extends BaseController{

    private function seguridad(){      
        $session = session();
        if(!$session->email != null || !$session->email != ''){
            $this->salir();
        }
    }

    public function salir(){
        $session = session();
        $session->destroy();
        header('Location: /public/login');
        exit;
    }
    
    private function links($arr){
        $html = '<li class="breadcrumb-item active"><a href="#">SIPSA 2023</a></li>';
        $end = end($arr);
        foreach ($arr as $key => $value) {
            if ($value === $end) {
                $html .= '<li class="breadcrumb-item active"><a href="'.$value.'">'.$key.'</a></li>';
            }
            else{
                $html .= '<li class="breadcrumb-item"><a href="'.$value.'">'.$key.'</a></li>';
            }
        }
        return $html;
    }

    public function index(){
        $this->seguridad();
        $data['titulo'] = 'Inicio';
        $data['descripcion'] = 'Descripción del menu inicio';
        $data['icono'] = 'fa fa-users';
        $data['m_usuarios']= 'activo';
        $data['links'] = $this->links(array('Inicio'=>base_url()));
        echo view('header',$data);
        echo view('inicio');
        echo view('footer');
    }
}
