@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
	<style type="text/css">
		.lSSlideOuter .lSPager.lSGallery img {
			display: block;
			height: 140px;
			max-width: 100%;
		}
		/* li.active {
		border: 2px solid ; */
	}
</style>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb"  style="background: none;">
	  <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
	  <li class="breadcrumb-item"><a href="{{url('/danh-muc/'.$cate_slug)}}">{{$product_cate}}</a></li>
	  <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
	  
	  <li> 
		  <div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button" data-size="small">
			  <a target="_blank" href="{{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a>
		  </div>
	  </li>
	</ol>
  </nav>
<div class="col-sm-5">

	<ul id="imageGallery">
	@foreach($gallery as $key => $gal)
	  <li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
		<img style="" width="100%" alt="{{$gal->gallery_name}}"  src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" style="border-radius: 10px;"/>
	  </li>
	 @endforeach
	  
	 
	</ul>

</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h1 style="font-weight: bold;color:#0F044C">{{$value->product_name}}</h1>
								<p>Mã ID: {{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								
								<form action="{{URL::to('/save-cart')}}" method="POST">
									@csrf
									<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">

                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                          
								<span>
									<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
								
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
								</span>
								<input type="button" value="Thêm giỏ hàng" class="btn  add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart" style="border:1px solid #0F044C">
								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mơi 100%</p>
								<p><b>Số lượng kho còn:</b> {{$value->product_quantity}}</p>
								<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
								<p><b>Danh mục:</b> {{$value->category_name}}</p>
								<style type="text/css">
									a.tags_style {
										margin: 3px 2px;
										padding: 5px
										border: 1px solid;
										height: 20px;
										weight: 30px;
										background:#fff ;
										color: #0F044C;
										padding: 0px;
										border-radius:10px;
									
									}
									a.tags_style:hover {
										background: #0F044C;
										color: #ffff;
										
									}
								</style>
								<fieldset>
									<legend>Tags</legend>
									
									<p><i class="fa fa-tag"></i>
										@php 
											$tags = $value->product_tags;
											$tags = explode(",",$tags);

										@endphp
											@foreach($tags as $tag)
												<a href="{{url('/tag/'.Str::slug($tag))}}" class="tags_style">{{$tag}}</a>
											@endforeach
									</p>
								</fieldset>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
							
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_desc!!}</p>
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->product_content!!}</p>
								
						
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Gửi đánh giá về chúng tôi</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>Chúng tôi sẽ cố gắng phản hồi sớm nhất</a></li>
										{{-- <li><a href=""><i class="fa fa-calendar-o"></i>16.09.2020</a></li> --}}
									</ul>
									<style type="text/css">
										.style_comment {
										    
										    border-radius: 10px;
										    background: #Fff;
										}
									</style>
									<form>
										@csrf
										<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
										<div id="comment_show"></div>
									
									</form>
									
									<p><b>Viết đánh giá của bạn</b></p>
									<form action="#">
										<span>
											<input style="width:100%;margin-left: 0;border-radius:10px;box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;color:#0F044C" type="text" class="comment_name" placeholder="Tên bình luận"/>
												
										</span>
										<textarea name="comment" class="comment_content" placeholder="Nội dung bình luận" style="border-radius:10px;box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset;color:#0F044C"></textarea>
										<div id="notify_comment"></div>
										
										<button type="button" class="btn btn-default pull-right send-comment">
											Gửi bình luận
										</button>

									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
							@foreach($relate as $key => $lienquan)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
		                            			<div class="productinfo text-center product-related">
		                                            <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
		                                            <h2>{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</h2>
		                                            <p>{{$lienquan->product_name}}</p>
		                                        </div>
                                			</div>
										</div>
									</div>
							@endforeach		

								
								</div>
									
							</div>
									
						</div>
					</div><!--/recommended_items-->
					  <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$relate->links()!!}
                      </ul>

@endsection