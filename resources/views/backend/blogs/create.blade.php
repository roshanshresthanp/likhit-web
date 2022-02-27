@extends('backend.layouts.master')
@push('style')
    <!-- summernote css -->
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.min.css')}}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create new blog <a href="{{ route('blog.index') }}" class="btn btn-primary">View Blogs</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blogs</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cover_image">Cover image:</label>
                                                    <input type="file" class="form-control" name="cover_image" id="cover_image" onchange="loadCover(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('cover_image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <img id="cover_image_output" style="height: 100px;">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="News Title">Main Title (In English):</label>
                                                    <input type="text" class="form-control" name="title[en]" placeholder="Enter Main Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="News Title">Main Title (In Nepali):</label>
                                                    <input type="text" class="form-control" name="title[np]" placeholder="Enter Main Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Descriptive Title">Descriptive Title (In English):</label>
                                                    <input type="text" class="form-control" name="descriptive_title[en]" placeholder="Enter Descriptive Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('descriptive_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Descriptive Title">Descriptive Title (In Nepali):</label>
                                                    <input type="text" class="form-control" name="descriptive_title[np]" placeholder="Enter Descriptive Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('descriptive_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Author">Author:</label>
                                                    <input type="text" class="form-control" name="author" placeholder="Author Name">
                                                    <p class="text-danger">
                                                        {{ $errors->first('author') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="News Title">Written On:</label>
                                                    <input type="date" class="form-control" name="written_date" value="{{ date('Y-m-d') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('written_date') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">News Content (In English):</label>
                                                    <textarea name="content[en]" class="summernote" class="form-control"></textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">News Content (In Nepali):</label>
                                                    <textarea name="content[np]" class="summernote" class="form-control"></textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" placeholder="Meta Title for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" placeholder="Meta Keywords for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description" cols="30" rows="5" class="form-control" placeholder="Meta description.."></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                {{-- <div class="form-group"> --}}
                                                    <label for="image">Image: </label>
                                                    <input type="file" class="" name="image" onchange="loadOg(event)">
                                                    {{-- <img id="outputFavicon" src="{{Storage::url($setting->favicon)}}" onerror="this.src='{{Storage::url('uploads/noimage.jpg')}}';" height="120px" width="140px"> --}}
                                                    <img id="image" src="{{Storage::url(isset($blog->image)?$blog->image:'noimage.jpg') }}" height="120px" width="140px" />

                                                    <p class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </p>
                                                {{-- </div> --}}
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <label for="">Current Og:</label> <br>
                                            </div> --}}

                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@push('script')
    <!-- summernote js -->
    <script src="{{asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script type="text/javascript">
        $('.summernote').summernote({
            // height: 200,
            // placeholder: "News content.."
        });
    </script>

<script>
    var loadOg = function(event) {
        var output = document.getElementById('image');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endpush
