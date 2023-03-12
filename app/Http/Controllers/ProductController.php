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
        $data = Product_name::with('categoryModel','ManufacturerModel')->Where('is_active',1)->get()->toArray();
        $category = Category::Where('is_active',1)->get();
        return view('add_product',['data'=>$data,'category'=>$category]);
    }

    // public function addProduct(Request $requst)
    // {   
    // }
    
    public function edit_product(Request $request)
    {
        $id = $request->id;
        $category = Category::Where('is_active',1)->get();
        $data = Product_name::with('categoryModel','ManufacturerModel')->Where(['id' => $id,'is_active'=>1])->first()->toArray();
        
        return view('edit_product',compact('data','category'));
    }

    public function set_product(Request $request)
    {
            $data['name'] = ucfirst(strtolower($request['product_name']));
            $data['category_id'] = ucfirst(strtolower($request['category_name']));
            $data['manufracture_id'] = ucfirst(strtolower($request['manu_name']));
            $data['is_active'] = 1;
            $data['user_id'] = $request['user_id'];
            $update = Product_name::Create($data);
            session()->flash('message', 'Data Add Successfully!'); 
            session()->flash('alert-class', 'alert-success'); 
            return back()->with(['status' =>  'success']);       
    }

    public function update_product(Request $request)
    {
        $data['name'] = ucfirst(strtolower($request['name']));
        $data['is_active'] = $request['is_active'];
        $data['user_id'] = $request['user_id'];
        $create = Product_name::Where('id',$request['tabel_id'])->Update($data);
        session()->flash('message', 'Data Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/product')->with(['status' =>  'success']);
    }
}