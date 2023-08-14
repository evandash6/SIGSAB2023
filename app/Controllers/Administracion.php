<?php

namespace App\Controllers;
use App\Libraries\RestClient;

class Administracion extends BaseController{

    private $api;

    function __construct() {
        $this->api = new RestClient([
			//LOCAL
            // 'base_url' => 'http://localhost/api/public/api',
            //API V2 PRODUCCION
            'base_url' => 'http://10.254.250.24/public/api/',
            'headers' => ['Ephylone'=>'sipsa'],
            'format' => ""]);
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
        $this->usuarios();
    }

    public function usuarios(){
        // $data['usuarios'] = $this->api->post('consulta_tabla',array('tabla'=>'usuarios'))->response;
        $data['usuarios'] = json_encode(array());
        $data['titulo'] = 'Administración - Usuarios';
        $data['descripcion'] = 'Módulo de administración de usuarios';
        $data['icono'] = 'fa fa-users';
        $data['m_usuarios']= 'active';
        $data['links'] = $this->links(array('Usuarios'=>base_url().'administracion/usuarios'));
        echo view('header',$data);
        echo view('administracion/usuarios');
        echo view('footer');
        echo view('funciones');
    }
    //Funcion para salir y eliminar la session de usuario
    public function salir(){
        $session = session();
        $session->destroy();
        // echo view('');
        exit;
    }
}
