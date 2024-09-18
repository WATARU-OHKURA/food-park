@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>App Download Section</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Section</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.app-download.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Image</label>
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="image" id="image-upload" />
                                    <input type="hidden" name="old_image" value="{{ @$appSection->image }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Backgound</label>
                                <div id="image-preview-2" class="image-preview bg-prev">
                                    <label for="image-upload-2" id="image-label-2">Choose File</label>
                                    <input type="file" name="background" id="image-upload-2" />
                                    <input type="hidden" name="old_bg" value="{{ @$appSection->background }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ @$appSection->title }}">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="short_description" id="" class="form-control">{{ @$appSection->short_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Play Store Link <code>(Leave empty for hide)</code></label>
                        <input type="text" class="form-control" name="ps_link" value="{{ @$appSection->play_store_link }}">
                    </div>

                    <div class="form-group">
                        <label for="">Apple Store Link <code>(Leave empty for hide)</code></label>
                        <input type="text" class="form-control" name="as_link" value="{{ @$appSection->app_store_link }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $.uploadPreview({
            input_field: "#image-upload-2", // Default: .image-upload
            preview_box: "#image-preview-2", // Default: .image-preview
            label_field: "#image-label-2", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ asset(@$appSection->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })

            $('.bg-prev').css({
                'background-image': 'url({{ asset(@$appSection->background) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
