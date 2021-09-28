<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Movement{
    public static function create($date, $amount, $type, $value, $id_product, $id_supplier ){
        DB::table("movement") -> insert([
            "date" => $date,
            "amount" => $amount,
            "type" => $type,
            "value" => $value,
            "id_product" => $id_product,
            "id_supplier" => $id_supplier,
        ]);
    }
    public static function list(){
        return DB::table("movement") -> get() -> toArray(); 
    }
    public static function update($id, $date, $amount, $type, $value, $id_product, $id_supplier){
        DB::table("movement") -> where([
            "id" => $id
        ]) -> update([
            "date" => $date,
            "amount" => $amount,
            "type" => $type,
            "value" => $value,
            "id_product" => $id_product,
            "id_supplier" => $id_supplier,
        ]);
    }
    public static function delete($id){
        DB::table("movement") -> where([
            "id" => $id 
        ]) -> delete();
    }
}
