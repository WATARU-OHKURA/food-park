@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Banner Slider</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Banner Slider</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.banner-slider.update', $banner_slider->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                            <input type="hidden" name="old_image" value="{{ $banner_slider->banner }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $banner_slider->title }}">
                    </div>

                    <div class="form-group">
                        <label for="">Sub Title</label>
                        <input type="text" class="form-control" name="sub_title" value="{{ $banner_slider->sub_title }}">
                    </div>

                    <div class="form-group">
                        <label for="">URL</label>
                        <input type="text" class="form-control" name="url" value="{{ $banner_slider->url }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option @selected($banner_slider->status == 1) value="1">Active</option>
                            <option @selected($banner_slider->status == 0) value="0">Inactive</option>
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
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($banner_slider->banner) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
