<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Clinic_location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\ClinicOrders;
use App\Category;
use App\Product_name;
use App\Manufacturer;
use App\Unit;
use App\Store;
use DB;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prodByCategory(Request $request)
    {
        $data = Product_name::select('id','name','unit_id','category_id','manufracture_id','prod_price')->where(['category_id'=>$request->cat_id,'manufracture_id'=>$request->man_id,'is_active'=>1])->get();
        return json_encode($data);
    }    
    public function priceByUnitCatMan(Request $request)
    {
        $cost = Store::where(['category'=>$request->cat_id,'manufacture_name'=>$request->man_id,'product_name'=>$request->prod_id ,'unit'=>$request->unit_id])->first()->cost;
        return json_encode($cost);
    }    
    public function unitByCategoryMan(Request $request)
    {
        $data = Unit::select('id','name')->whereIn('id',[DB::raw('Select CONCAT(unit_id) from product_name where category_id='.$request->cat_id.' AND manufracture_id='.$request->man_id.' AND id='.$request->prod_id)])->get();
        return json_encode($data);
    }    
    public function unitByProduct(Request $request)
    {
        $data = Unit::select('id','name')->where(['id'=>$request->unit_id,'is_active'=>1])->first();
        return json_encode($data);
    }    
    public function manufractureByCategory(Request $request)
    {
        $data = Manufacturer::select('id','name')->where(['category_id'=>$request->cat_id,'is_active'=>1])->get();
        return json_encode($data);
    }    
    public function orderFinalSubmit(Request $request)
    {   
        if(count($request->productArray)){
            $product_data = [];
            $order_id= date('dmyhis');
            foreach($request->productArray AS $prd){
                $product_price = Store::where(['category'=>$prd['itemData']['category_id'],'manufacture_name'=>$prd['itemData']['manufracture_id'],'product_name'=>$prd['itemData']['product_id'] ,'unit'=>$prd['itemData']['unit_name']])->first()->cost;
                $product_data[] = [
                                'order_id'=> $order_id,
                                'product_id'=> $prd['itemData']['product_id'],
                                'category_id'=> $prd['itemData']['category_id'],
                                'manfracture_id'=> $prd['itemData']['manufracture_id'],
                                'product_qty'=> $prd['itemData']['prodct_qty'],
                                'product_unit'=> $prd['itemData']['unit_name'],
                                'price_per_unit'=> $product_price,
                                'total_price'=> $product_price*$prd['itemData']['prodct_qty'],
                                'user_id'=> Auth::user()->id,
                                'clinic_id'=> Auth::user()->location_id,
                                'clinic_location'=> Auth::user()->location_id,
                                'received_remarks'=> 'N/A',
                                'short_description'=> 'Please placed order in Next 3 Days',
                                ];
            }
            if(count($product_data)){
                $id = ClinicOrders::insert($product_data);
                if($id){
                    return array('message'=> 'Order Placed Succssfully!','status'=>'success');
                }                
            }
            return array('message'=> 'Oops! Somthing Went wrong','status'=>'error');
        }
    }    
}
