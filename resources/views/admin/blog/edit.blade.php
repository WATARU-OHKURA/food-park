@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Blog</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control select2" id="">
                            <option value="">select</option>
                            @foreach ($categories as $category)
                                <option @selected($category->id == $blog->category_id) value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control summernote" name="description">{!! $blog->description !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>SEO Title</label>
                        <input type="text" name="seo_title" class="form-control" value="{{ $blog->seo_title }}">
                    </div>

                    <div class="form-group">
                        <label>SEO Description</label>
                        <textarea class="form-control" name="seo_description">{{ old('seo_description', $blog->seo_description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option @selected($blog->status == 1) value="1">Active</option>
                            <option @selected($blog->status == 0) value="0">Inactive</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ $blog->image }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
