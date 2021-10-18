<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class MovementController extends BaseController
{
    public function create (Request $request){
        $date = $request->input('date');
        $amount = $request->input('amount');
        $type = $request->input('type');
        $value = $request->input('value');
        $id_product = $request->input('id_product');
        $id_supplier = $request->input('id_supplier');
        Movement::create($date, $amount, $type, $value, $id_product, $id_supplier);
        Product::updateAverageCost($id_product, $amount, $value);
        Product::addAmount($id_product, $amount);
        return redirect('/movement/');
    }
    public function list(){
        $movements = Movement::list();
        return view("movementlist", [
            "movements" => $movements
        ]);
    }
    public function update(Request $request){
        $id = $request->input('id');
        $date = $request->input('date');
        $amount = $request->input('amount');
        $type = $request->input('type');
        $value = $request->input('value');
        $id_product = $request->input('id_product');
        $id_supplier = $request->input('id_supplier');
        Movement::update($id, $date, $amount, $type, $value, $id_product, $id_supplier);
        return redirect('/movement/');
    }
    public function delete(Request $request){
        $id = $request->input('id');
        Movement::delete($id);
        return redirect('/movement/');
    }
}