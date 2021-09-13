<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Supplier{
    public static function create($name, $cnpj){
        DB::table("supplier") -> insert([
            "name" => $name,
            "cnpj" => $cnpj,
        ]);
    }
    public static function list(){
        return DB::table("supplier") -> get() -> toArray(); 
    }
    public static function update($id, $name, $cnpj){
        DB::table("supplier") -> where([
            "id" => $id
        ]) -> update([
            "name" => $name,
            "cnpj" => $cnpj,
        ]);
    }
    public static function delete($id){
        DB::table("supplier") -> where([
            "id" => $id 
        ]) -> delete();
    }
}
