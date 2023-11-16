@extends('layouts.app')

@section('body')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Services</h1>
                    <p class="mb-4">Discover the perfect blend of style and comfort at our furniture store. Immerse yourself in a world of meticulously crafted pieces that redefine your living spaces.</p>
                    <p><a href="/shop" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="images/couch.png" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->



<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">


        <div class="row my-5">
            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="images/truck.svg" alt="Shipping" class="imf-fluid">
                    </div>
                    <h3>Fast Shipping</h3>
                    <p>Quick and free shipping for a seamless experience. Nullam ac aliquet velit. Aliquam vulputate.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="images/bag.svg" alt="Shopping" class="imf-fluid">
                    </div>
                    <h3>Easy Shopping</h3>
                    <p>Simplify your shopping experience. Nullam ac aliquet velit. Aliquam vulputate.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="images/support.svg" alt="Support" class="imf-fluid">
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Get assistance anytime, anywhere. Nullam ac aliquet velit. Aliquam vulputate.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="images/return.svg" alt="Returns" class="imf-fluid">
                    </div>
                    <h3>Hassle-Free Returns</h3>
                    <p>Enjoy easy and stress-free returns. Nullam ac aliquet velit. Aliquam vulputate.</p>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Why Choose Us Section -->

<!-- Start Product Section -->
<div class="product-section">
	<div class="container">
		<div class="row">

			<!-- Start Column 1 -->
			<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
				<h2 class="mb-4 section-title">Quality Craftsmanship</h2>
				<p class="mb-4">Discover durability and timeless design in our furniture collection. Each piece is crafted with exceptional materials, ensuring both style and longevity. Elevate your spaces with our curated selection that blends luxury with functionality.</p>
				<p><a href="/shop" class="btn">Explore</a></p>
			</div>


			<!-- End Column 1 -->

			<!-- Start Column 2 -->
			@if(isset($item) && $item->count() > 0)
            @foreach($item as $rs)
			<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
				<a class="product-item" href="cart.html">
					<img src="{{ asset('storage/' . $rs->image) }}" class="img-fluid product-thumbnail">
					<h3 class="product-title">{{ $rs->title }}</h3>
					<strong class="product-price">{{ $rs->price }}</strong>

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
			<!-- End Column 2 -->
		</div>
	</div>
</div>
<!-- End Product Section -->



@endsection