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
        $totalCost = $product -> average_cost * $product -> amount;
        $addCost = $addAmount * $cost;
        $newAmount = $product -> amount + $addAmount;
        DB::table("product") -> where([
            "id" => $id
        ]) -> update([
            "average_cost" => ($totalCost + $addCost) / $newAmount
        ]);
    }
}
