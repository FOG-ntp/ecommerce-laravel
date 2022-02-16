<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Toastr;
session_start();

class CouponController extends Controller
{
    
    public function insert_coupon()
    {
        return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Toastr::error('Thao tác thành công', 'Xóa mã giảm giá !',);
        return Redirect::to('list-coupon');
    }
    public function list_coupon()
    {
        $coupon = Coupon::orderby('coupon_id', 'DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function insert_coupon_code(Request $request)
    {
        $data = $request->all();

        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_status = $data['coupon_status'];
        $coupon->save();

        Toastr::success('Thao tác thành công', 'Thêm mã giảm giá !',);
        return Redirect::to('insert-coupon');

    }
    public function unactive_coupon($coupon_id)
    {
        //$this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->update(['coupon_status' => 1]);
        Session::put('message', 'Không kích hoạt Mã giảm giá thành công');
        return Redirect::to('list-coupon');

    }
    public function active_coupon($coupon_id)
    {
        //$this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->update(['coupon_status' => 0]);
        Session::put('message', 'Kích hoạt Mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }

    public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
}
