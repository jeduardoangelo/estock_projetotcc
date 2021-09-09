<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Suplier{
    public static function create(){
        dd("Create");
    }
    public static function list(){
        return DB::table("supplier") -> get() -> toArray(); 
    }
    public static function update(){
        dd("Atualizar");
    }
    public static function delete(){
        dd("Excluir");
    }
}
