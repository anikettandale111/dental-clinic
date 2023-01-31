<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;

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
        }
        else{
            $action = 3;
        }
        $data = Auth::user()->where(['action' => $action,'status'=>'Active','ref_id'=>Auth::user()->id])->get();
        
        return view('clinic_details',compact('data'));
    }

    public function add_store(Request $requst)
    {   
        return view('auth.register');
    }
    
    public function edit_details(Request $requst)
    {
        $id = $requst->id;
        
        $data = Auth::user()->where(['id' => $id])->first()->toArray();
        
        return view('auth.edit_register',compact('data'));
    }

    protected function edit_register(Request $requst)
    {
        
        $data['name'] = ucfirst(strtolower($requst['name']));
        $data['address'] = ucfirst(strtolower($requst['address']));
        $data['location'] = ucfirst(strtolower($requst['location']));
        $data['status'] = $requst['status'];
        $update = User::where('id',$requst->id)->Update($data);
        session()->flash('message', 'This is a message!'); 
        session()->flash('alert-class', 'alert-success'); 
        return Redirect::back()->with(['message'   =>  "Successfully data update",
        'status'    =>  'success']);
    }
    
}
