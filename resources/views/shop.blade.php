@extends('layouts.app')

@section('body')
<!-- Start Hero Section -->
<style>
    .product-item {
        display: block;
        position: relative;
        text-align: center;
        text-decoration: none;
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 20px;
        height: 100%;
        /* Set a fixed height for the container */
    }

    .product-thumbnail {
        width: 100%;
        /* Make the image fill the container width */
        height: auto;
        /* Maintain the image's aspect ratio */
    }

    .product-title {
        margin-top: 10px;
        font-size: 16px;
    }

    .product-price {
        display: block;
        margin-top: 5px;
        font-weight: bold;
        color: #333;
    }

    .icon-cross {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>



<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                    <p class="mb-4">Discover the perfect blend of style and comfort at our furniture store. Immerse yourself in a world of meticulously crafted pieces that redefine your living spaces. </p>
                    <p><a href="/shop" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->



<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
              @auth
            <!-- Start Column 1 -->
            @if(isset($item) && $item->count() > 0)
            @foreach($item as $rs)
            <div class="col-12 col-md-4 col-lg-3 mb-5">
                <a class="product-item" href="#">
                    <img src="{{ asset('storage/' . $rs->image) }}" class="img-fluid product-thumbnail">
                    <h3 class="product-title">{{ $rs->title }}</h3>
                    <strong class="product-price">{{ $rs->price }}</strong>
                    <form action="{{ route('razorpay.payment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $rs->id }}">
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="{{ $rs->price * 100 }}" data-buttontext="Buy Now" data-name="{{ $rs->title }}" data-description="Razorpay payment for {{ $rs->title }}" data-image="/images/logo-icon.png" data-prefill.name="{{ auth()->user()->name }}" data-prefill.email="{{ auth()->user()->email }}" data-theme.color="#ff7529">
                        </script>
                    </form>

                    <span class="icon-cross">
                        <img src="images/cross.svg" class="img-fluid">
                    </span>
                </a>
            </div>
            @endforeach
            @else
            <tr>
                <td class="text-center" colspan="5">Product not found</td>
            </tr>
            @endif
            <!-- End Column 1 -->



        </div>
    </div>
</div>
@endauth
@endsection