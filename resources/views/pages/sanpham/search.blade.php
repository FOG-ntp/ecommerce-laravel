@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
          <li class="active">Kết quả tìm kiếm </li>
        </ol>
      </div>
                        <h2 class="title text-center">Kết quả tìm kiếm</h2>
                       @foreach($search_product as $key => $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper" data-aos="fade-up"
                            data-aos-duration="2500">
                             <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                                            <p>{{$product->product_name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        </div>
                                      
                                </div>
                            </a>
                                {{-- <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items--> 
        <!--/recommended_items-->
@endsection