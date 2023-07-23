<?php

namespace App\Controllers;

class Inicio extends BaseController
{
    public function index(){
        $data['titulo'] = 'Inicio';
        $data['descripcion'] = 'Descripción del menu inicio';
        $data['icono'] = '';
        echo view('header',$data);
        echo view('inicio');
        echo view('footer');
    }
}
