@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Our Team</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update member's Info</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.our-team.update', $our_team->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                            <input type="hidden" name="old_image" value="{{ $our_team->image }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $our_team->name }}">
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $our_team->title }}">
                    </div>

                    <br>
                    <h5>Social Links</h5>
                    <div class="form-group">
                        <label for="">Facebook <code>(Leave empty for hide)</code></label>
                        <input type="text" class="form-control" name="fb" value="{{ $our_team->fb }}">
                    </div>

                    <div class="form-group">
                        <label for="">LinkedIn <code>(Leave empty for hide)</code></label>
                        <input type="text" class="form-control" name="in" value="{{ $our_team->in }}">
                    </div>

                    <div class="form-group">
                        <label for="">X <code>(Leave empty for hide)</code></label>
                        <input type="text" class="form-control" name="x" value="{{ $our_team->x }}">
                    </div>

                    <div class="form-group">
                        <label for="">Web <code>(Leave empty for hide)</code></label>
                        <input type="text" class="form-control" name="web" value="{{ $our_team->web }}">
                    </div>

                    <div class="form-group">
                        <label>Show At Home</label>
                        <select name="show_at_home" class="form-control" id="">
                            <option @selected($our_team->show_at_home == 0) value="0">No</option>
                            <option @selected($our_team->show_at_home == 1) value="1">Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option @selected($our_team->status == 1) value="1">Active</option>
                            <option @selected($our_team->status == 0) value="0">Inactive</option>
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
                'background-image': 'url({{ asset($our_team->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
