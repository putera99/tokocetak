@extends('beranda.layouts2.master')

@section('content')
<div class="shop">
    <div class="container">

        <div class="row">
			<div class="col-lg-3">
				@include('user.sidebar')
            </div>
            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count" style="color:#0E8CE4;"><span>Total : {{ \Wishlist::count(\Auth::user()->id) }}</span> Produk Favorit</div>
                        
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>
                        <!-- Product Item -->
                        @foreach($produk as $pk)
                        <a href="{{route('detail', ['s' => str_replace(' ','-',strtolower($pk->StoreName)),'p'=>str_replace(' ','-',strtolower($pk->ProductName)),'title'=>str_replace(' ','-',strtolower($pk->Title)).'?id='.$pk->StoreProductID ])}}">
                            <div class="product_item discount" style="display: inline-flex;">
                                <div class="product_border"></div>
                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img style="width: 115px;height: 115px;" src="{{ asset('uploads/'.$pk->FotoThumbnail) }}" alt=""></div>
                                <div class="product_content">
                                    <div class="product_price">Rp. {{ str_replace(',','.',number_format($pk->PriceFrom,0)) }}</div>
                                    <div class="product_name"><div>{{ str_limit($pk->Title,25) }}</a></div></div>
                                </div>
                                <ul class="product_marks">
                                    @if($pk->discount > 0)
                                    <li class="product_mark product_discount">-{{ $pk->discount }}%</li>
                                    @endif
                                </ul>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="shop_page_nav d-flex flex-row">
                        {{$produk->links()}}
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<script src="{{asset('onetech/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('onetech/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('onetech/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('onetech/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('onetech/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('onetech/plugins/easing/easing.js')}}"></script>
<script src="{{asset('onetech/js/product_custom.js')}}"></script>
<script src="{{asset('onetech/js/shop_custom.js')}}"></script>

@endsection