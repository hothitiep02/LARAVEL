@extends('master')
@section('content')
<div class="container">
    <div class="row">
        @foreach( $products as $new)
        <div class="col-sm-3">
          <div class="single-item">
            <div class="single-item-header">
              <a href="detail/{{$new->id}}"><img width="200" height="200"
                  src="/source/image/product/{{$new->image}}" alt=""></a>
            </div>
            @if($new->promotion_price==!0)
            <div class="ribbon-wrapper">
              <div class="ribbon sale">Tiep</div>
            </div>
            @endif
            <div class="single-item-body">
              <p class="single-item-title">{{$new->name}}</p>
              <p class="single-item-price" style="text-align:left;font-size: 15px;">
                @if($new->promotion_price==0)

                <span class="flash-sale">{{number_format($new->unit_price)}} Đồng</span>
                @else
                <span class="flash-del">{{number_format($new->unit_price)}} Đồng </span>
                <span class="flash-sale">{{number_format($new->promotion_price)}} Đồng</span>
                @endif
              </p>
            </div>
            <div class="single-item-caption">
              <a class="add-to-cart pull-left" href=""><i
                  class="fa fa-shopping-cart"></i></a>

              <a class="add-to-wishlist" href="wishlist/add/{{$new->id}}"><i class="fa fa-heart"></i></a>

              <a class="beta-btn primary" href="detail/{{$new->id}}">Details <i
                  class="fa fa-chevron-right"></i></a>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      {{-- <div class="row">{{$new_product->links("pagination::bootstrap-4")}}</div> --}}
    </div> <!-- .beta-products-list -->
</div>
@endsection