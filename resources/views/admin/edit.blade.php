@extends('AdminLayouts.app')

@section('admin_body')
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Edit Product</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-md-6">
                        <form action="{{ route('update', $product->id) }}" method="POST" class="tm-edit-product-form">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" value="{{ $product->title }}" class="form-control validate" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input id="price" name="price" type="number" value="{{ $product->price }}" class="form-control validate" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="product_code">Product Code</label>
                                <input id="product_code" name="product_code" type="text" value="{{ $product->product_code }}" class="form-control validate" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control validate tm-small" rows="5" required>{{ $product->description }}</textarea>
                            </div>
                            <!-- Other fields, if needed -->
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection