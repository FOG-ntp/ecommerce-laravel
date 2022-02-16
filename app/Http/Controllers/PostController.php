<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Slider;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\CatePost;
use Toastr;
session_start();

class PostController extends Controller
{
    public function AuthLogin()
    {

        if (Session::get('login_normal')) {

            $admin_id = Session::get('admin_id');
        } else {
            $admin_id = Auth::id();
        }
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }

    }
    public function add_post()
    {
        //$this->AuthLogin();
        $cate_post = CatePost::orderBy('cate_post_id', 'DESC')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));

    }
    public function save_post(Request $request)
    {
        //$this->AuthLogin();
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); //lay ten của hình ảnh
            $name_image = current(explode('.', $get_name_image));

            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();

            $get_image->move('public/uploads/post', $new_image);

            $post->post_image = $new_image;

            $post->save();
            Toastr::success('Thao tác thành công', 'Thêm bài viết !',);
            return redirect()->back();
        } else {
            Session::put('message', 'Làm ơn thêm hình ảnh');
            return redirect()->back();
        }

    }
    public function all_post()
    {
        //$this->AuthLogin();

        $all_post = Post::with('cate_post')->orderBy('cate_post_id')->get();

        return view('admin.post.list_post')->with(compact('all_post', $all_post));

    }
    public function delete_post($post_id)
    {
        //$this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;

        if ($post_image) {
            $path = 'public/uploads/post/' . $post_image;
            unlink($path);
        }
        $post->delete();

        Toastr::error('Thao tác thành công', 'Xóa bài viết !',);
        return redirect()->back();
    }

    public function edit_post($post_id)
    {
        $cate_post = CatePost::orderBy('cate_post_id')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit_post')->with(compact('post', 'cate_post'));
    }
    public function update_post(Request $request, $post_id)
    {
        //$this->AuthLogin();
        $data = $request->all();
        $post = Post::find($post_id);

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');

        if ($get_image) {
            //xoa anh cu
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/' . $post_image_old;
            unlink($path);
            //cap nhat anh moi
            $get_name_image = $get_image->getClientOriginalName(); //lay ten của hình ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post', $new_image);
            $post->post_image = $new_image;
        }

        $post->save();
        Toastr::info('Cập nhật sản phẩm thành công', 'Cập nhật bài viết!',);
        return redirect()->back();
    }
    public function danh_muc_bai_viet(Request $request, $post_slug)
    {
        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        //slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(3)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $catepost = CatePost::where('cate_post_slug', $post_slug)->take(1)->get();

        foreach ($catepost as $key => $cate) {
            //seo
            $meta_desc = $cate->cate_post_desc;
            $meta_keywords = $cate->cate_post_slug;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $url_canonical = $request->url();
            $share_image = url('public/frontend/images/share_news.png');
            //--seo
        }

        $post_cate = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_id)->paginate(5);

        return view('pages.baiviet.danhmucbaiviet')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider', $slider)->with('post_cate', $post_cate)->with('category_post', $category_post)->with('share_image', $share_image);
    }
    public function bai_viet(Request $request, $post_slug)
    {

        //category post
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        //slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $post_by_id = Post::with('cate_post')->where('post_status', 0)->where('post_slug', $post_slug)->take(1)->get();

        foreach ($post_by_id as $key => $p) {
            //seo
            $meta_desc = $p->post_meta_desc;
            $meta_keywords = $p->post_meta_keywords;
            $meta_title = $p->post_title;
            $cate_id = $p->cate_post_id;
            $url_canonical = $request->url();
            $cate_post_id = $p->cate_post_id;
            $post_id = $p->post_id;
            $share_image = url('public/uploads/post/' . $p->post_image);
            //--seo
        }
        //update views
        $post = Post::where('post_id', $post_id)->first();
        $post->post_views = $post->post_views + 1;
        $post->save();

        //related post
        $related = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_post_id)->whereNotIn('post_slug', [$post_slug])->take(5)->get();

        return view('pages.baiviet.baiviet')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider', $slider)->with('post_by_id', $post_by_id)->with('category_post', $category_post)->with('related', $related)->with('share_image', $share_image);
    }
}
