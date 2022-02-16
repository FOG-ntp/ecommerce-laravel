<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\CategoryProductModel;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{

    public function index(Request $request)
    {

        
        //category post
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();

        //slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(3)->get();

        /* SEO */
        $meta_desc = "Tô điểm thế giới bên trong ngôi nhà của bạn"; /* khi mà người dùng nhập site+tên miền sẽ hiện trên lên trang index */
        $meta_keywords = "thiet bi noi that, nội thất, do dung trang trí, noi that gia dinh ";
        $meta_title = "Make My Home";
        $url_canonical = $request->url();
        /* SEO */

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->paginate(6);
        $cate_pro_tabs = CategoryProductModel::where('category_parent',0)->orderBy('category_id','DESC')->get();

        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs);
        /* return view('pages.home')->with(compact('cate_product','brand_product','all_product')); */
    }

    public function search(Request $request)
    {

        //category post
        $category_post = CatePost::orderBy('cate_post_id','asc')->get();

        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(3)->get();

        //seo
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

        return view('pages.sanpham.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    //Gửi Mail
    public function send_mail()
    {
        $to_name = "ntphong20it12";
        $to_email = "ntphong.20it12@vku.udn.vn"; //send to this email

        $data = array("name" => "Mail từ tài khoản khách hàng", "body" => "Mail gửi về vấn đề hàng hóa"); //body of mail.blade.php

        Mail::send('pages.send_mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject('test mail nhé'); //send this mail with subject
            $message->from($to_email, $to_name); //send from this mail
        });
        return Redirect('/')->with('message', '');

    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){

            $product = Product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative">'
            ;

            foreach($product as $key => $val){
            $output .= '
            <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
            ';
        }

        $output .= '</ul>';
        echo $output;
        }
}
}
