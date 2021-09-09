<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class SuplierController extends BaseController
{
    public function create (){
        dd("Criar");
    }
    public function list(){
        return view("suplierlist");
    }
    public function update(){
        dd("Atualizar");
    }
    public function delete(){
        dd("Excluir");
    }
}
