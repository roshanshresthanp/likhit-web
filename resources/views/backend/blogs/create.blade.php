@extends('backend.layouts.master')
@push('style')
    <!-- summernote css -->
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.min.css')}}">
<style>
.switch {
  display: inline-block;
  height: 34px;
  position: relative;
  width: 60px;
}

.switch input {
  display:none;
}

.slider {
  background-color: #ccc;
  bottom: 0;
  cursor: pointer;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  transition: .4s;
}

.slider:before {
  background-color: #fff;
  bottom: 4px;
  content: "";
  height: 26px;
  left: 4px;
  position: absolute;
  transition: .4s;
  width: 26px;
}

input:checked + .slider {
  background-color: #21c8f1;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
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
                                    @isset($blog)
                                    <form action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                    @else
                                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                    @endisset
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="News Title">Title :</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{isset($blog)?$blog->title:old('title') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Descriptive Title">Posted by:</label>
                                                    <input type="text" class="form-control" name="posted_by" value="{{isset($blog)?$blog->posted_by:old('posted_by')}}" placeholder="Author name">
                                                    <p class="text-danger">
                                                        {{ $errors->first('posted_by') }}
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Author">Author:</label>
                                                    <input type="text" class="form-control" name="author" placeholder="Author Name">
                                                    <p class="text-danger">
                                                        {{ $errors->first('author') }}
                                                    </p>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <label for="image">Image: </label>
                                                <input type="file" class="" name="image" onchange="loadOg(event)">
                                                {{-- <img id="outputFavicon" src="{{Storage::url($setting->favicon)}}" onerror="this.src='{{Storage::url('uploads/noimage.jpg')}}';" height="120px" width="140px"> --}}
                                                <img id="image" src="{{Storage::url(isset($blog->image)?$blog->image:'uploads/noimage.jpg') }}" height="120px" width="120px" />
                                                <p class="text-danger">
                                                    {{ $errors->first('image') }}
                                                </p>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                                                  </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <label>Active</label><br>
                                                    <label class="switch" for="checkbox">
                                                        <input type="checkbox" name="publish_status" value="1" id="checkbox" />
                                                        <div class="slider round"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">Description:</label>
                                                    <textarea name="description" class="summernote" class="form-control"> {{isset($blog)?$blog->description:old('description') }}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('description') }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-12 text-center">
                                                <hr><h3>Meta Information</h3><hr>
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

                                             --}}

                        

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
            height: 100
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
