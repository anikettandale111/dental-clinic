<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Clinic_location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
        return view('home');
    }
    public function clinic_details(Request $requst)
    {
        if(Auth::user()->action == 1)
        {
            $action = 2;
            $where = ['action' => $action,'status'=>'Active'];
        }
        else{
            $action = 3;
            $where = ['action' => $action,'status'=>'Active','ref_id'=>Auth::user()->id];
        }
        $data = Auth::user()->with('Clinic_location')->where($where)->get();
        return view('clinic_details',compact('data'));
    }

    public function add_store(Request $requst)
    {   
        $branch = Clinic_location::Where('user_id',Auth::user()->id)->get();
        return view('auth.register',compact('branch'));
    }
    
    public function edit_details(Request $requst)
    {
        $id = $requst->id;
        
        $data = Auth::user()->with('Clinic_location')->where(['id' => $id])->first()->toArray();
        $branch = Clinic_location::Where('user_id',Auth::user()->id)->get();
        
        return view('auth.edit_register',compact('data','branch'));
    }

    protected function edit_register(Request $requst)
    {
        
        $data['name'] = ucfirst(strtolower($requst['name']));
        $data['address'] = ucfirst(strtolower($requst['address']));
        $data['location_id'] = $requst['location_id'];
        $data['status'] = $requst['status'];
        $data['mobile_number']= $requst['mobile_number'];
        $data['pan_card']=strtoupper(strtolower($requst['pan_card']));
        $data['aadhar_card']=strtoupper(strtolower($requst['aadhar_card']));
        $update = User::where('id',$requst->id)->Update($data);
        session()->flash('message', 'This is a message!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::to('/clinic_details')->with(['status' =>  'success']);
    }

    protected function create(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);


        if($data->action_id == 1)
        {
            $action = 2;
        }
        else{
            $action = 3;
        }
        User::create([
            'name' => ucfirst(strtolower($data->name)),
            'email' => $data->email,
            'address' => ucfirst(strtolower($data->address)),
            'location_id' => $data->location_id,
            'status' => 'Active',
            'action' => $action,
            'mobile_number'=>$data->mobile_number,
            'pan_card'=>strtoupper(strtolower($data->pan_card)),
            'aadhar_card'=>strtoupper(strtolower($data->aadhar_card)),
            'ref_id' => Auth::user()->id,
            'password' => Hash::make($data->password)
        ]);
        return Redirect::to('/clinic_details')->with(['status' =>  'success']);
    }
    
}
