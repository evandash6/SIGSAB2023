<?php

namespace App\Controllers;
use App\Libraries\RestClient;

class Login extends BaseController{

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
    public function index(){
        return view('login');
        //echo $this->api->post('consulta_tabla',array('tabla'=>'usuarios'))->response;
    }

    //Funcion para validación de usuarios a traves de la API CONAFOR
    public function validar(){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $res = json_decode($this->api->post('autorizacion',array('usuario'=>$usuario,'password'=>$password))->response);
        // var_dump($res);
        if($res->status == 200){
            $usu = json_decode($this->api->post('consulta_tabla',array('tabla'=>'usuarios','condicion[email]'=>$usuario,'condicion[activo]'=>1))->response);
            if($usu->totalregistros>0){
                $session = session();
                $session->set('usuario_id',$usu->resultado[0]->id);
                $session->set('num_emp',$res->datos->num_emp);
                $session->set('nombre',$res->datos->nombre);
                $session->set('email',$res->datos->email);
                $session->set('perfil_id',$usu->resultado[0]->perfil_id);
                // header('Location: '.base_url().'/Administracion');
                exit;
            }
            else{
                $arr['nombre'] =$res->datos->nombre;
                $arr['num_empleado'] =$res->datos->num_emp;
                $arr['email'] =$res->datos->email;
                $arr['fecha_registro'] = date('Y-m-d H:i:s');
                $res2 = $this->api->post('insertar/usuarios',$arr)->response;
                // echo view('previos/header');
                // echo view('previos/aviso');
            }     
        }
        else{
            // header('Location: '.base_url().'/login');
            exit;
        }
    }

    //Funcion para salir y eliminar la session de usuario
    public function salir(){
        $session = session();
        $session->destroy();
        // echo view('');
        exit;
    }
}
