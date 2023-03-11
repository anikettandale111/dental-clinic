<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product_name;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $data = product_name::get();
        
        $data = product_name::get();
        return view('add_product',['data'=>$data]);
    }

    public function addProduct(Request $requst)
    {   
    }
    
    public function edit_product(Request $request)
    {
        $id = $request->id;
        
        $data = product_name::Where(['id' => $id])->first()->toArray();
        
        return view('edit_product',compact('data'));
    }

    public function set_product(Request $request)
    {
            $data['name'] = ucfirst(strtolower($request['product_name']));
            $data['is_active'] = 1;
            $data['user_id'] = $request['user_id'];
            $update = product_name::Create($data);
            session()->flash('message', 'Data Add Successfully!'); 
            session()->flash('alert-class', 'alert-success'); 
            return back()->with(['status' =>  'success']);       
    }

    public function update_product(Request $request)
    {
        $data['name'] = ucfirst(strtolower($request['name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = product_name::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/product')->with(['status' =>  'success']);
    }
}