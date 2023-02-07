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
        
        return view('product',compact('data'));
    }

    public function add_manufacturer(Request $requst)
    {   
        return view('add_manufacturer');
    }
    
    public function edit_category(Request $request)
    {
        $id = $request->id;
        
        $data = product_name::Where(['id' => $id])->first()->toArray();
        
        return view('edit_category',compact('data'));
    }

    public function set_manufacturer(Request $request)
    {
            $data['name'] = ucfirst(strtolower($request['manufacturer_name']));
            $data['is_active'] = 1;
            $data['user_id'] = $request['user_id'];
            $update = product_name::Create($data);
            session()->flash('message', 'Data Add Successfully!'); 
            session()->flash('alert-class', 'alert-success'); 
            return back()->with(['status' =>  'success']);       
    }

    public function update_category(Request $request)
    {
        $data['name'] = ucfirst(strtolower($request['manufacturer_name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = product_name::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/category')->with(['status' =>  'success']);
    }
}