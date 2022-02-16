<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Statistic;
use App\Models\Order;
use App\Models\Visitors;
use App\Models\Product;
use App\Models\Post;
use App\Models\Customer;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Auth;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){

        if(Session::get('login_normal')){
    
            $admin_id = Session::get('admin_id');
        }else{
            $admin_id = Auth::id();
        }
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        } 
    
    
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(Request $request){
        $this->AuthLogin();
        $user_ip_address = $request->ip();  

    $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();

    $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

    $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

    $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
    $visitor_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get(); 
    $visitor_last_month_count = $visitor_of_lastmonth->count();

        //total this month
    $visitor_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get(); 
    $visitor_this_month_count = $visitor_of_thismonth->count();

        //total in one year
    $visitor_of_year = Visitors::whereBetween('date_visitor',[$oneyears,$now])->get(); 
    $visitor_year_count = $visitor_of_year->count();

        //total visitors
    $visitors = Visitors::all();
    $visitors_total = $visitors->count();

        //current online
    $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();  
    $visitor_count = $visitors_current->count();

    if($visitor_count<1){
        $visitor = new Visitors();
        $visitor->ip_address = $user_ip_address;
        $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $visitor->save();
    }

        //total 
    $product = Product::all()->count();
    $post = Post::all()->count();
    $order = Order::all()->count();
    /* $video = Video::all()->count(); */
    $customer = Customer::all()->count();

    $product_views = Product::orderBy('product_views','DESC')->take(10)->get();
    $post_views = Post::orderBy('post_views','DESC')->take(10)->get();


    return view('admin.dashboard')->with(compact('visitors_total','visitor_count','visitor_last_month_count','visitor_this_month_count','visitor_year_count','product','post','order'/* ,'video' */,'customer','product_views','post_views'));
    }

    public function dashboard(Request $request){
    	$admin_email = $request['admin_email'];
    $admin_password = md5($request['admin_password']);
    $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    if($login){
        $login_count = $login->count();
        if($login_count>0){
            Session::put('admin_name',$login->admin_name);
            Session::put('admin_id',$login->admin_id);
            return Redirect::to('/dashboard');
        }
    }else{
        Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
        return Redirect::to('/admin');
    }
    }

    public function logout(){
        //$this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function filter_by_date(Request $request){

        $data = $request->all();
    
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
    
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
    
    
        foreach($get as $key => $val){
    
            $chart_data[] = array(
    
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);  
    
    }
    public function days_order(){

        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
        $get = Statistic::whereBetween('order_date',[$sub60days,$now])->orderBy('order_date','ASC')->get();
    
    
        foreach($get as $key => $val){
    
           $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
        );
    
       }
    
       echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){

        $data = $request->all();
    
            // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
           // $tomorrow = Carbon::now('Asia/Ho_Chi_Minh')->addDay()->format('d-m-Y H:i:s');
           // $lastWeek = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->format('d-m-Y H:i:s');
           // $sub15days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(15)->format('d-m-Y H:i:s');
           // $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('d-m-Y H:i:s');
    
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
    
    
    
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    
        $dauthang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->toDateString();
        $cuoithang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->endOfMonth()->toDateString();
    
    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
        if($data['dashboard_value']=='7ngay'){
    
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
    
        }elseif($data['dashboard_value']=='thangtruoc'){
    
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
    
        }elseif($data['dashboard_value']=='thangnay'){
    
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
    
        }elseif ($data['dashboard_value']=='thang9') {
    
            $get = Statistic::whereBetween('order_date',[$dauthang9,$cuoithang9])->orderBy('order_date','ASC')->get();
    
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
    
    
        foreach($get as $key => $val){
    
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);
    
    }

    public function order_date(Request $request){
        $order_date = $_GET['date'];
        $order = Order::where('order_date',$order_date)->orderby('created_at','DESC')->get();
        return view('admin.order_date')->with(compact('order'));
    }
}
