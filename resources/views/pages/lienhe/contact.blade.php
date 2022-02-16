@extends('layout')
@section('content')
<div class="features_items">
                        <h2 class="title text-center" style="margin-top:10px">Liên hệ với chúng tôi</h2>
                        <div class="row">
                            @foreach($contact as $key => $cont)
                            
                            <div class="col-md-12" style="display:flex; justify-content: space-between">
                                {!!$cont->info_fanpage!!}
                                {!!$cont->info_contact!!}
                                
                            </div>
                            
                            <div class="col-md-12" style="display:flex; align-items:center;  justify-content: center; margin-top:30px; ">
                                {!!$cont->info_map!!}
                            </div>
                            
                        @endforeach
</div>
@endsection