@extends('layouts.app')

@section('body')

<!-- End Hero Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7">
                <h2 class="section-title">{{ $blog->title }}</h2>
                <div class="meta">
                    <span>by <a href="#">{{ $blog->user->name }}</a></span>
                    <span>on <a href="#">{{ $blog->updated_at}}</a></span>
                </div>
                @if(auth()->check() && $blog->user_id == auth()->user()->id)
                <div class="my-3">
                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('blog.edit', $blog->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger-outline" onclick="return confirm('Are you sure you want to delete this blog?')"><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                </div>
                @endif

                <div class="row my-5">
                    <div class="col-12">
                        <p class="text-dark">{!! $blog->content !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</div>

@endsection