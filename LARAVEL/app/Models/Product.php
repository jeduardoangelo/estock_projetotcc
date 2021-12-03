<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Prophecy\Promise\ReturnPromise;

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
    public static function update($id, $name, $ncm, $amount, $metric, $average_cost){
        DB::table("product") -> where([
            "id" => $id
        ]) -> update([
            "name" => $name,
            "ncm" => $ncm,
            "amount" => $amount,
            "metric" => $metric,
            "average_cost" => $average_cost,
        ]);
    }
    public static function delete($id){
        DB::table("product") -> where([
            "id" => $id 
        ]) -> delete();
    }
    public static function addAmount($id, $amount){
        $product = DB::table("product") -> find($id);
        DB::table("product") -> where([
            "id" => $id
        ]) -> update([
            "amount" => $amount + $product -> amount,
        ]);
    }
    public static function updateAverageCost($id, $addAmount, $cost){
        $product = DB::table("product") -> find($id);
        $newAmount =  $product -> amount + $addAmount;
        
        $totalCost = static::getSumCost($id);
        $newCost = $totalCost / $newAmount;

        DB::table("product") -> where([
            "id" => $id
        ]) -> update([
            "average_cost" => $newCost
        ]);
    }
    public static function getSumCost($id){
        return DB::table("movement") -> where([
            "id_product" => $id
        ]) -> sum("value");
    }
    public static function find($id){
        return DB::table("product") -> find($id);
    }
}