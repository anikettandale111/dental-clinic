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
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prodByCategory()
    {
        $data = ClinicOrders::all();
        return view('orders.received_orders',$data);
    }    
    public function receivedOrders(Request $request)
    {
        $data['my_orders'] = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'))->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.order_status',0)->groupBy('clinic_orders.order_id')->orderBy('clinic_orders.id')->get();
        return view('orders.received_orders',$data);
    }    
    public function getOrderById(Request $request)
    {
        $data = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks','pn.name','clinic_orders.product_qty','clinic_orders.product_unit','clinic_orders.price_per_unit')->leftJoin('product_name AS pn','pn.id','=','clinic_orders.product_id')->where('clinic_orders.order_id',$request->order_id)->orderBy('clinic_orders.id')->get();
        return json_encode($data);
    }    
    public function purchaseOrder()
    {
        $data['category'] = Category::where('is_active',1)->get();
        return view('orders.purchase_orders',$data);
    }    
    public function viewMyOrders()
    {
        $data['my_orders'] = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'))->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.user_id',Auth::user()->id)->groupBy('clinic_orders.order_id')->orderBy('clinic_orders.id')->get();
        return view('orders.view_my_orders',$data);
    }    
    public function deleteOrder(Request $request)
    {
        ClinicOrders::where('order_id',$request->id)->delete();
        $data['my_orders'] = ClinicOrders::select('clinic_orders.id','order_id','clinic_orders.created_at','total_price','order_status','received_remarks',DB::raw('GROUP_CONCAT(product_name.name) AS product_name'),DB::raw('GROUP_CONCAT(clinic_orders.product_qty) AS product_qty'))->leftJoin('product_name','product_name.id','=','clinic_orders.product_id')->where('clinic_orders.user_id',Auth::user()->id)->groupBy('clinic_orders.order_id')->orderBy('clinic_orders.id')->get();
        session()->flash('message', 'Order Deleted Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/view_my_orders')->with(['status' =>  'success']);
    }    
}
