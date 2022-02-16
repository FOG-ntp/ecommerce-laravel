<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Toastr;

session_start();
class GalleryController extends Controller
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
    public function add_gallery($product_id)
    {
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));

    }
    public function update_gallery_name(Request $request)
    {
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }
    public function insert_gallery(Request $request, $pro_id)
    {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('public/uploads/gallery', $new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        Toastr::success('Thao tác thành công', 'Thêm thư viện ảnh !',);
        return redirect()->back();

    }
    public function delete_gallery(Request $request)
    {
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/uploads/gallery/' . $gallery->gallery_image);
        $gallery->delete();
    }
    public function update_gallery(Request $request)
    {
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if ($get_image) {
            $gallery = Gallery::find($gal_id);
            unlink('public/uploads/gallery/' . $gallery->gallery_image);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/gallery', $new_image);
            $gallery->gallery_image = $new_image;
            $gallery->save();
        }
    }
    public function select_gallery(Request $request)
    {
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = ' <form>
    					' . csrf_field() . '

    					<table class="table table-hover">
                                    <thead>
                                      <tr>
                                      	<th>Thứ tự</th>
                                        <th>Tên hình ảnh</th>
                                        <th>Hình ảnh</th>
                                        <th>Quản lý</th>
                                      </tr>
                                    </thead>
                                    <tbody>

    	';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '

    				 <tr>
    				 					<td>' . $i . '</td>
                                        <td contenteditable class="edit_gal_name" data-gal_id="' . $gal->gallery_id . '">' . $gal->gallery_name . '</td>
                                        <td>

                                        <img src="' . url('public/uploads/gallery/' . $gal->gallery_image) . '" class="img-thumbnail" width="120" height="120">

                                        <input type="file" class="file_image" style="width:40%" data-gal_id="' . $gal->gallery_id . '" id="file-' . $gal->gallery_id . '" name="file" accept="image/*" />

                                        </td>
                                        <td>
                                        	<button type="button" data-gal_id="' . $gal->gallery_id . '" class="btn btn-xs btn-danger delete-gallery">Xóa</button>
                                        </td>
                                      </tr>




    			';
            }
        } else {
            $output .= '
    				 <tr>
                                        <td colspan="4">Sản phẩm chưa thư viện ảnh</td>

                                      </tr>


    			';

        }
        $output .= '
    				 </tbody>
    				 </table>
    				 </form>


    			';
        echo $output;
    }
}
