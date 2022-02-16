 <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>@lang('lang.danhmuc')</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                          @foreach($category as $key => $cate)
                            
                           
                            <div class="panel panel-default">

                               @if($cate->category_parent==0)   
                                <div class="panel-heading">
                                    <h4 class="panel-title">

                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            {{$cate->category_name}}
                                        </a>

                                    </h4>
                                </div>

                                <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($category as $key => $cate_sub)
                                                @if($cate_sub->category_parent==$cate->category_id)
                                                    <li><a href="{{URL::to('/danh-muc/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                              
                                

                            </div>
                          
                          
                        @endforeach

                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu/'.$brand->brand_slug)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Sản phẩm đã xem</h2>
                            <div class="brands-name ">

                                <div id="row_viewed" class="row">    

                                </div>

                            </div>
                        </div><!--/brands_products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Sản phẩm yêu thích</h2>
                            <div class="brands-name ">

                                <div id="row_wishlist" class="row">    

                                </div>

                            </div>
                        </div><!--/brands_products-->

                      
                        
                     
                    
                    </div>
                </div>