@extends('backend.layouts.master')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Content Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">content</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              {{-- <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div> --}}
              <!-- /.card-header -->
              <!-- form start -->
                @if(isset($content)) 
                <form action="{{route('content.update',$content->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                @else
                <form action="{{route('content.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                @endif
              
                <div class="card-body row">
                  
                  <div class="form-group col-sm-6">
                    <label for="name">Menu title</label>
                    <input type="text" class="form-control" name="menu_title" value="{{isset($content)?$content->menu_title: old('menu_title')}}">
                    <p style="color: red">{{$errors->first('menu_title')}}</p>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="title">Content Page title</label>
                    <input type="text" class="form-control" name="title" value="{{isset($content)?$content->title: old('title')}}">
                    <p style="color: red">{{$errors->first('title')}}</p>

                  </div>
                  <div class="form-group col-sm-6 mb-0">
                    <label for="address">Parallex Image</label> <br>
                    <input type="file" name="parallex_img"  accept="image/*" onchange="loadFile(event)">
                    <img id="output" src="{{Storage::url(isset($content)?$content->parallex_img: '')}}" onerror="this.src='{{Storage::url('uploads/noimage.jpg')}}';"  height="120px" width="140px">
                    <p style="color: red">{{$errors->first('parallex_img')}}</p>

                  </div>
                  <div class="form-group col-sm-6 mb-0">
                    <label for="address">Featured Image</label> <br>
                    <input type="file" name="featured_img" accept="image/*" onchange="loadFavicon(event)">
                    <img id="outputFavicon" src="{{Storage::url(isset($content)?$content->featured_img: '')}}"  onerror="this.src='{{Storage::url('uploads/noimage.jpg')}}';" height="120px" width="140px">
                    <p style="color: red">{{$errors->first('featured_img')}}</p>

                  </div>

                  <div class="form-group col-md-6">
                    <label>Content type</label>
                    <select class="select2 form-control" name="type_id" style="width:100%;">
                      {{-- <option >Alabama</option> --}}
                      @foreach ($contentType as $data)
                      <option value="{{$data->id}}" @if(isset($content)) @if($content->type->id==$data->type_id) selected @endif @endif >{{$data->title}}</option>
                      @endforeach
                    </select>
                    <p style="color: red">{{$errors->first('type_id')}}</p>

                  </div>
                  <div class="form-group col-sm-6">
                    <label for="address">External link (if any)</label>
                    <input type="text" class="form-control" name="external_link" value="{{isset($content)?$content->external_link: old('external_link')}}">
                    <p style="color:red;">{{$errors->first('external_link')}}</p>

                  </div>
                  {{-- <div class="form-group col-sm-6">
                    <label for="content_url">Content Url</label>
                    <input type="text" class="form-control" name="content_url" value="{{isset($content)?$content->content_url: old('content_url')}}">
                    <p style="color:red;">{{$errors->first('content_url')}}</p>

                  </div> --}}
                  {{-- <div class="form-group col-sm-6 mb-0">
                    <label for="address">Logo</label> <br>
                    <input type="file" name="logo"  accept="image/*" onchange="loadFile(event)">
                    <img id="output" src="{{Storage::url(isset($content)?$content->logo: '')}}" onerror="this.src='{{Storage::url('uploads/noimage.jpg')}}';" height="120px" width="140px">
                  </div>
                  <div class="form-group col-sm-6 mb-0">
                    <label for="address">Favicon (Optional)</label> <br>
                    <input type="file" name="favicon" accept="image/*" onchange="loadFavicon(event)">
                    <img id="outputFavicon" src="{{Storage::url(isset($content)?$content->favicon: '')}}" onerror="this.src='{{Storage::url('uploads/noimage.jpg')}}';" height="120px" width="140px">
                  </div> --}}
                  
                
                  
                  {{-- <div class="form-group col-sm-12">
                    <label for="map">Show On</label>

                    <input type="checkbox" class="form-check" name="show_on[]" value="header" @if(isset($content)) in_array($check,'header')? checked :'';  @endif>
                    <input type="checkbox" class="form-check" name="show_on[]" value="footer" @if(isset($content)) in_array($check,'footer')? checked :'';  @endif>

                  </div> --}}
                  <div class="form-group col-sm-6">
                    <label for="map">Show On</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="show_on[]" value="header" @if(isset($content)) @if(in_array('header',json_decode($content->show_on))) checked @endif  @endif>
                      {{-- <input type="checkbox" class="form-check" > --}}

                      <label class="form-check-label">Header</label>
                    </div>
                    <div class="form-check">
                      {{-- <input class="form-check-input" type="checkbox" checked> --}}
                      <input class="form-check-input" type="checkbox" name="show_on[]" value="footer" @if(isset($content)) @if(in_array('footer',json_decode($content->show_on))) checked @endif  @endif>

                      <label class="form-check-label">Footer</label>
                    </div>
                  </div>

                  
                    <div class="form-group col-sm-6">
                      <label>Publish status</label><br>
                      <input type="checkbox" name="publish_status" value="1" @if(isset($content) && ($content->publish_status==1)) checked  @endif status data-off-color="danger" data-on-color="success">
                    </div>
                  <div class="form-group col-sm-12">
                    <label for="address">Content description</label>
                    <textarea rows="5" class="form-control summernote" name="description"> {!!isset($content)?$content->description:old('description')!!}</textarea>
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="address">Content summary</label>
                    <textarea rows="5" class="form-control summernote" name="summary"> {!!isset($content)?$content->summary:old('summary')!!}</textarea>
                  </div>
                  
                  

                  {{-- <div class="form-group col-sm-6">
                    <label for="email">Content email</label>
                    <input type="email" class="form-control" name="email" value="{{isset($content)?$content->email: ''}}">
                  </div> --}}
                  {{-- <div class="form-group col-sm-6">
                    <label for="gmail">Content gmail (Optional)</label>
                    <input type="email" class="form-control" name="gmail" value="{{isset($content)?$content->gmail: ''}}">
                  </div> --}}
                  {{-- <div class="form-group col-sm-6">
                    <label for="phone">Phone no.</label>
                    <input type="text" class="form-control" name="phone" value="{{isset($content)?$content->phone: ''}}">
                  </div> --}}
                  
                 
                 
                  {{-- <div class="form-group col-sm-12">
                    <label for="address">Content description</label>
                    <textarea rows="4" class="form-control summernote" name="description"> {!!isset($content)?$content->description:''!!}</textarea>
                  </div> --}}

                  

                  {{-- <div class="col-md-12">
                    <p class="text-center p-3">------ SOCIAL MEDIA LINKS ------</p>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="facebook">Facebook link</label>
                    <input type="text" class="form-control" name="facebook" value="{{isset($content)?$content->facebook: ''}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="instagram">Instagram link</label>
                    <input type="text" class="form-control" name="instagram" value="{{isset($content)?$content->instagram: ''}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="linkedin">Linkedin link</label>
                    <input type="text" class="form-control" name="linkedIn" value="{{isset($content)?$content->linkedIn: ''}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="twitter">Twitter link</label>
                    <input type="text" class="form-control" name="twitter" value="{{isset($content)?$content->twitter: ''}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="youtube">Youtube link</label>
                    <input type="text" class="form-control" name="youtube" value="{{isset($content)?$content->youtube: ''}}">
                  </div> --}}
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Submit</button> &nbsp; &nbsp;
                  {{-- <button type="reset" class="btn btn-danger">Clear</button> --}}

                </div>
              </form>
            </div>
            <!-- /.card -->

           

          </div>
          <!--/.col (left) -->
         
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@push('script')
<script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote(),
    $('.select2').select2(),
    
    $("input[status]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
  });

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };

  var loadFavicon = function(event) {
    var output = document.getElementById('outputFavicon');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endpush