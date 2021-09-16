<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Product{
    public static function create($name, $ncm, $amount, $metric, $average_cost ){
        DB::table("product") -> insert([
            "name" => $name,
            "ncm" => $ncm,
            "amount" => $amount,
            "metric" => $metric,
            "average_cost" => $average_cost,
        ]);
    }
    public static function list(){
        return DB::table("product") -> get() -> toArray(); 
    }
    public static function delete($id){
        DB::table("product") -> where([
            "id" => $id 
        ]) -> delete();
    }
}
