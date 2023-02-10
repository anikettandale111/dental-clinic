<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Store;
use App\Dispatch;
use App\Clinic_location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DispatchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['dispatch_data'] = Dispatch::select('dispatch.created_at','dispatch.received_qty','dispatch.id AS disp_id','users.name AS u_name','store.barcode_id','product_name.name AS p_name','clinic_location.location','clinic_location.branch_name','store.photo')
                                ->join('store', 'store.barcode_id', '=', 'dispatch.qr_code')
                                ->join('users', 'users.id', '=', 'dispatch.transfer_by_id')
                                ->join('clinic_location', 'dispatch.branch_id', '=', 'clinic_location.id')
                                ->join('product_name', 'store.product_name', '=', 'product_name.id')
                                ->where('transfer_by_id',Auth::user()->id)->get();        
        return view('dispatch_view',$data);
    }
    public function clinic_details(Request $request)
    {
        if(Auth::user()->action == 1)
        {
            $action = 2;
        }
        else{
            $action = 3;
        }
        $data = Auth::user()->where(['action' => $action,'status'=>'Active','ref_id'=>Auth::user()->id])->get();
        
        return view('clinic_details',compact('data'));
    }
    public function add_dispatch(Request $request)
    {       
        $data['store_list'] = Clinic_location::select()->where('is_active',1)->where('user_id',Auth::user()->id)->get();
        return view('add_dispatch',$data);
    }
    public function insert_dispatch(Request $request)
    {   
        // $data['product_name'] = $request['product_name'];
        // $data['category_name'] = $request['category_name'];
        // $data['available_qty'] = $request['available_qty'];
        $data['received_qty'] = $request['disp_quantity'];
        $data['qr_code'] = $request['barcode_text'];
        $data['branch_id'] = $request['reciver_id'];
        $data['transfer_by_id'] = Auth::user()->id;
        $rowid = Dispatch::insertGetId($data);
        if($rowid > 0){
            Store::where('barcode_id',$request['barcode_text'])->decrement('qty',$request['disp_quantity']);
        }
        return array('message'=> 'Dispatch Entry Inserted Successfully!','status'=>'success'); 
    }

    public function add_stock(Request $request)
    {   
        return view('stock');
    }
    public function get_bar_code_data(Request $request)
    {   
        return Store::where('barcode_id',$request->barcode_text)->first();
    }
    
    public function edit_stock(Request $request)
    {
        $id = $request->id;
        
        $data = Store::Where(['id' => $id])->first()->toArray();
        
        return view('edit_stock',compact('data'));
    }

    protected function stock_register(Request $request)
    {
        
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/images');
            $image->move($destinationPath, $image_name);

            $data['user_id'] = $request['user_id'];
            $data['category'] = ucfirst(strtolower($request['category']));
            $data['manufacture_name'] = ucfirst(strtolower($request['manufacture_name']));
            $data['product_name'] = ucfirst(strtolower($request['product_name']));
            $data['usage'] = ucfirst(strtolower($request['usage']));
            $data['unit'] = ucfirst(strtolower($request['unit']));
            $data['photo'] = $image_name;
            $data['qty'] = $request['qty'];
            $data['tags'] = $request['tags'];
            $data['description'] = ucfirst(strtolower($request['description']));
            $data['is_active'] = 1;
            $update = Store::Create($data);
            session()->flash('message', 'Product Add Successfully!'); 
            session()->flash('alert-class', 'alert-success'); 
            return back()->with(['status' =>  'success']);
        } 
        else 
        {                          
            Session()->flash('message','Wrong image uploaded');
            Session()->flash('status','success');
            session()->flash('alert-class', 'alert-danger'); 
            return back()->with(['status' =>  'success']);
        }
    }

    protected function update_stock(Request $request)
    {
        if ($request->hasFile('photo')) 
        {
            $image = $request->file('photo');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/images');
            $image->move($destinationPath, $image_name);
        } 
        else
        {
            $image_name = $request['old_photo'];
        }
        $update = Store::Where('id',$request['tabel_id'])->update(['is_active'=>0]);
        $data['user_id'] = $request['user_id'];
        $data['category'] = ucfirst(strtolower($request['category']));
        $data['manufacture_name'] = ucfirst(strtolower($request['manufacture_name']));
        $data['product_name'] = ucfirst(strtolower($request['product_name']));
        $data['usage'] = ucfirst(strtolower($request['usage']));
        $data['unit'] = ucfirst(strtolower($request['unit']));
        $data['photo'] = $image_name;
        $data['qty'] = $request['qty'];
        $data['tags'] = $request['tags'];
        $data['description'] = ucfirst(strtolower($request['description']));
        $data['is_active'] = 1;
        $create = Store::Create($data);
        session()->flash('message', 'Product Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/store-eq')->with(['status' =>  'success']);
    }
}