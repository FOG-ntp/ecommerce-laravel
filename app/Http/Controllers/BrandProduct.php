<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\CatePost;
/* use DB; */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/* use Session; */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Toastr;
session_start();
class BrandProduct extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product()
    {
        ////$this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        ////$this->AuthLogin();
        //$all_brand_product = DB::table('tbl_brand')->get(); //static huong doi tuong
        // $all_brand_product = Brand::all();
        $all_brand_product = Brand::orderBy('brand_id', 'DESC')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);

    }
    public function save_brand_product(Request $request)
    {
        ////$this->AuthLogin();
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->brand_slug;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;
        // DB::table('tbl_brand')->insert($data);

        Toastr::success('Thao tác thành công', 'Thêm thương hiệu sản phẩm !',);
        return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id)
    {
        ////$this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Toastr::warning('Thao tác thành công', 'Thay đổi trạng thái !',);
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id)
    {
        ////$this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Toastr::warning('Thao tác thành công', 'Thay đổi trạng thái !',);
        return Redirect::to('all-brand-product');

    }
    public function edit_brand_product($brand_product_id)
    {
        ////$this->AuthLogin();

        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id)
    {
        ////$this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        /* $brand->brand_status = $data['brand_product_status']; */
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->brand_slug;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Toastr::info('Thao tác thành công', 'Cập nhật thương hiệu !',);
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        ////$this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Toastr::error('Thao tác thành công', 'Xóa thương hiệu sản phẩm !',);
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page

    public function show_brand_home(Request $request, $brand_slug)
    {
        //category post
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
        //slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')->where('tbl_brand.brand_slug', $brand_slug)->paginate(6);

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug', $brand_slug)->limit(1)->get();

        foreach ($brand_name as $key => $val) {
            //seo
            $meta_desc = $val->brand_desc;
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo
        }

        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider', $slider)->with('category_post',$category_post);
    }
}
