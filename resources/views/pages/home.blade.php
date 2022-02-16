@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm mới nhất</h2>
                        @foreach($all_product as $key => $product)
                        
                        <div class="col-sm-4" >
                            <div class="product-image-wrapper" data-aos="fade-up"
                            data-aos-duration="2700">
                                
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <i class="ribbon">New</i>
                                            <form>
                                                @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                                
                                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                            
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">
                                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                                <p>{{$product->product_name}}</p>
                                            </a>
                                            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                                            </form>
                                        </div>
                                </div>
                                
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        {{--  <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->
                    {{-- <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$all_product->links()!!}
                        </ul> --}}
                    <div class="category-tab" data-aos="fade-up"
                    data-aos-duration="2500"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($cate_pro_tabs as $key => $cat_tab)
                                    @php 
                                    $i++;
                                    @endphp
                                <li class="tabs_pro {{$i==1 ? 'active' : ''}}" data-id="{{$cat_tab->category_id}}"><a href="#tshirt" data-toggle="tab">{{$cat_tab->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="tabs_product" data-aos="fade-up"
                        data-aos-duration="2700"></div>
                    </div>
                       
                        
        <!--/recommended_items-->
         
@endsection