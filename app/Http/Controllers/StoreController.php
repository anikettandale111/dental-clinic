<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Store;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use PDF;

class StoreController extends Controller
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
        $data = Store::Where(['user_id'=>Auth::user()->id,'is_active'=>1])->get();
        $category = Category::get();
        
        return view('store_view',compact('data','category'));
    }
    public function clinic_details(Request $requst)
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

    public function add_stock(Request $requst)
    {   
        $category = Category::get();
        return view('stock',compact('category'));
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

            $row_data=[];
            $QR_data=[];
            // for($i=1;$i<=$request['qty'];$i++){
                // $qr_id = date('ymdhis'.$i);
                $qr_id = date('ymdhis');
                $row_data = array('user_id'=> $request['user_id'],
                        'category'=> ucfirst(strtolower($request['category'])),
                        'manufacture_name'=> ucfirst(strtolower($request['manufacture_name'])),
                        'product_name'=> ucfirst(strtolower($request['product_name'])),
                        'usage'=> ucfirst(strtolower($request['usage'])),
                        'unit'=> ucfirst(strtolower($request['unit'])),
                        'photo'=> $image_name,
                        'qty'=> $request['qty'],
                        'cost'=> $request['cost'],
                        'tags'=> $request['tags'],
                        'description'=> ucfirst(strtolower($request['description'])),
                        'is_active'=> 1,
                        'barcode_id'=> $qr_id,
                        'is_scanned'=> 0,
                        'is_print'=> 0,
                    );
                    $update = Store::Create($row_data);
                    $QR_data[] = $qr_id;
                //DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
                //array_merge($row_data,$data);
            // }
            $data_new  = ['product_name'=>$request['product_name'],'QR_data'=>$QR_data,'quantity'=>$request['qty']];
            view()->share('data_new',$data_new);
            $pdf_file_name = date('y_m_d').'_'.$request['product_name'].'_qrpdf.pdf';
            $pdf = PDF::loadView('qrpdf')->save(public_path($pdf_file_name));
            // $pdf->download('qrpdf.pdf');
            session()->flash('message', 'Product Add Successfully!  <a href="/'.$pdf_file_name.'" target="_blank"> View Barcode </a>'); 
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
        // $row_data=[];
        // for($i=1;$i<=$request['qty'];$i++){
            $data['user_id'] = $request['user_id'];
            $data['category'] = ucfirst(strtolower($request['category']));
            $data['manufacture_name'] = ucfirst(strtolower($request['manufacture_name']));
            $data['product_name'] = ucfirst(strtolower($request['product_name']));
            $data['usage'] = ucfirst(strtolower($request['usage']));
            $data['unit'] = ucfirst(strtolower($request['unit']));
            $data['photo'] = $image_name;
            $data['qty'] = $request['qty'];
            $data['cost']= $request['cost'];
            $data['tags'] = $request['tags'];
            $data['description'] = ucfirst(strtolower($request['description']));
            //DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
            // array_push($row_data,$data);
        // }
        Store::Create($data);
        session()->flash('message', 'Product Update Successfully!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/store-eq')->with(['status' =>  'success']);
    }
    function qr_generator(Request $request){
        // ALTER TABLE `store` ADD `barcode_id` BIGINT NOT NULL AFTER `tags`, ADD `is_scanned` TINYINT NOT NULL DEFAULT '0' AFTER `barcode_id`, ADD `is_print` TINYINT NOT NULL DEFAULT '0' AFTER `is_scanned`;
        $j = 10000;
        for($i=1;$i<=$j;$i++){
            $lbl_txt= date('ymdhis'.$i);
            echo DNS1D::getBarcodeSVG($lbl_txt, "C93",1,30,'green', true);
        }
    }
}