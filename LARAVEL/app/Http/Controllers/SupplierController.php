<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SupplierController extends BaseController
{
    public function create (Request $request){
        $name = $request->input('name');
        $cnpj = $request->input('cnpj');
        Supplier::create($name, $cnpj);
        return redirect('/supplier/');
    }
    public function list(){
        $suppliers = Supplier::list();
        return view("supplierlist", [
            "suppliers" => $suppliers
        ]);
    }
    public function update(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $cnpj = $request->input('cnpj');
        Supplier::update($id, $name, $cnpj);
        return redirect('/supplier/');
    }
    public function delete(Request $request){
        $id = $request->input('id');
        Supplier::delete($id);
        return redirect('/supplier/');
    }
}
