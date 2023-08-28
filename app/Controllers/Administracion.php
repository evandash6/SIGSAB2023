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

    //Funcion para salir y eliminar la session de usuario
    public function salir(){
        $session = session();
        $session->destroy();
        // echo view('');
        exit;
    }

    private function seguridad(){      
        $session = session();
        if(!$session->email != null || !$session->email != ''){
            $this->salir();
        }
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
        $data['perfiles_opc'] = $this->api->post('crea_select',array('tabla'=>'c_perfiles','condicion'=>' activo=1 ORDER BY nombre'))['opciones'];
        $data['links'] = $this->links(array('Usuarios'=>base_url().'administracion/usuarios'));
        echo view('header',$data);
        echo view('administracion/usuarios');
        echo view('footer');
        echo view('funciones');
    }

    public function  muestra_usuarios(){
        echo $this->api->post('consulta_tabla',array('tabla'=>'vw_usuarios'))->response;
    }

    public function activa_usuarios($id,$val){
        $this->seguridad();
        $val = ($val==1)?0:1;
        echo $this->api->post('actualizar/usuarios',array('datos[activo]'=>$val,'condicion[id]'=>$id))->response;
    }

    public function actualiza_usuarios(){
        $this->seguridad();
        $id = $_POST['id'];
        unset($_POST['id']);
        echo $this->api->post('actualizar/usuarios',array('datos'=>$_POST,'condicion[id]'=>$id))->response;
    }

    public function importacion(){
        // $data['usuarios'] = $this->api->post('consulta_tabla',array('tabla'=>'usuarios'))->response;
        $data['usuarios'] = json_encode(array());
        $data['titulo'] = 'Administración - Importación de Datos';
        $data['descripcion'] = 'Módulo de Importación de Datos';
        $data['icono'] = 'fa fa-users';
        $data['m_importacion']= 'active';
        $data['perfiles_opc'] = $this->api->post('crea_select',array('tabla'=>'c_perfiles','condicion'=>' activo=1 ORDER BY nombre'))['opciones'];
        $data['links'] = $this->links(array('Usuarios'=>base_url().'administracion/importacion'));
        echo view('header',$data);
        echo view('administracion/importacion');
        echo view('footer');
        echo view('funciones');
    }
}
