@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
			<style type="text/css">
				p.title_thongke {
				    text-align: center;
				    font-size: 20px;
				    font-weight: bold;
					text-transform: uppercase;
					color:#fff;
				}
			</style>
<div class="row">
		<p class="title_thongke" >Thống kê đơn hàng doanh số</p>

		<form autocomplete="off">
			@csrf

			<div class="col-md-2">
				<p style="color:#fff;font-weight: bold">Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

				<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>

			</div>

			<div class="col-md-2">
				<p style="color:#fff;font-weight: bold">Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
			</div>

			<div class="col-md-2">
				<p style="color:#fff;font-weight: bold">
					Lọc theo: 
					<select class="dashboard-filter form-control" >
						<option>--Chọn--</option>
						
						<option value="7ngay">7 ngày qua</option>
						<option value="thangtruoc">tháng trước</option>
						<option value="thangnay">tháng này</option>
						<option value="365ngayqua">365 ngày qua</option>
					</select>
				</p>
			</div>

		</form>

		<div class="col-md-12">
			<div id="chart" style="height: 250px;"></div>
		</div>

</div>

<div class="row">
	<style type="text/css">
		table.table.table-bordered.table-dark {
		    background: #fff;
			
		}
		table.table.table-bordered.table-dark tr th {
		    color: #0F044C;
			font-weight: bold;
			font-size: 20px;
		}
	</style>

{{-- <p class="title_thongke">Thống kê truy cập</p>

<table class="table table-bordered table-dark" >
  <thead>
    <tr>
      <th scope="col">Đang online</th>
      <th scope="col">Tổng tháng trước</th>
      <th scope="col">Tổng tháng này</th>
      <th scope="col">Tổng một năm</th>
      <th scope="col">Tổng truy cập</th>
    </tr>
  </thead>
  <tbody>
    <tr style="color: #0F044C;
	font-weight: bold;
	font-size: 20px;">
		<td>{{$visitor_count}}</td>
		<td>{{$visitor_last_month_count}}</td>
		<td>{{$visitor_this_month_count}}</td>
		<td>{{$visitor_year_count}}</td>
		<td>{{$visitors_total}}</td>
    </tr>
   
  </tbody>
</table> --}}

</div>

<div class="row">

	<div class="col-md-4 col-xs-12">
		<p class="title_thongke">Thống kê tổng quát</p>
		<div id="donut"></div>	
	</div>

	<!--------------------------->

	<div class="col-md-4 col-xs-12">
		<h3 style="color:white">Bài viết xem nhiều</h3>

		<ol class="list_views">
			@foreach($post_views as $key => $post)
			<li>
				<a target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} - <span style="color:#f24f7c">{{$post->post_views}}</span></a>
			</li>
			@endforeach
		</ol>
		
	</div>

	<div class="col-md-4 col-xs-12">
		<style type="text/css">
			ol.list_views {
			    margin: 10px 0;
			    color: #fff;
			}
			ol.list_views a {
			    color: white;
			    font-weight: 400;
			}
		</style>
		<h3 style="color:white">Sản phẩm xem nhiều</h3>

		<ol class="list_views">
			@foreach($product_views as $key => $pro)
			<li>
				<a target="_blank" href="{{url('/chi-tiet/'.$pro->product_slug)}}">{{$pro->product_name}} - <span style="color:#f24f7c">{{$pro->product_views}}</span></a>
			</li>
			@endforeach
		</ol>

	</div>
</div>


</div>

@endsection