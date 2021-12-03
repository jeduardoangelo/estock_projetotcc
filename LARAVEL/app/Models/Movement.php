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
        return DB::table("movement") -> select(
            "movement.*", "product.name as name_p", "supplier.name as name_s"
            ) 
        -> join("product","product.id", "=", "movement.id_product")
        -> leftJoin("supplier", "supplier.id", "=", "movement.id_supplier") 
        -> get()
        -> toArray(); 
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
