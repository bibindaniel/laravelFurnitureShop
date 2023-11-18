@extends('layouts.app')

@section('body')
<!-- Include CKEditor from CDN -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Add a section for editing an existing blog -->
            <div class="post-entry">
                <h3 class="text-center mb-4">Make Changes To Your Blog</h3>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Blog Editing Form -->
                <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use the PUT method for updates -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="title">Title</label>
                                <input type="text" class="form-control" value="{{ $blog->title }}" id="title" name="title">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label class="text-black" for="content">Content</label>
                        <textarea name="content" class="form-control ckeditor" id="content" cols="30" rows="5">{{ $blog->content }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-hover-outline">Update</button>
                </form>
                <!-- End Blog Editing Form -->
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('content', {
        entities: false,
        basicEntities: false
    });
</script>
@endsection
