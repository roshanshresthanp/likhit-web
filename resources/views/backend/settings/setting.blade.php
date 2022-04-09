  @extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Company Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">setting</li>
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
              <form action="{{route('setting.update',1)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                  
                  <div class="form-group col-sm-6">
                    <label for="name">Company name</label>
                    <input type="text" class="form-control" name="name" value="{{$setting->name}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="title">Company title</label>
                    <input type="text" class="form-control" name="title" value="{{$setting->title}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="email">Company email</label>
                    <input type="email" class="form-control" name="email" value="{{$setting->email}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="gmail">Company gmail (Optional)</label>
                    <input type="email" class="form-control" name="gmail" value="{{$setting->gmail}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="phone">Phone no.</label>
                    <input type="text" class="form-control" name="phone" value="{{$setting->phone}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="address">Company address</label>
                    <input type="text" class="form-control" name="address" value="{{$setting->address}}">
                    {{-- <p class="text-danger">{{$errors->first('address')}}</p> --}}

                  </div>
                  <div class="form-group col-sm-6 mb-0">
                    <label for="address">Logo</label> <br>
                    <input type="file" name="logo"  accept="image/*" onchange="loadFile(event)">
                    <img id="output" src="{{Storage::disk('uploads')->url($setting->logo?? 'noimage.jpg')}}" height="120px" width="140px">
                  </div>
                  <div class="form-group col-sm-6 mb-0">
                    <label for="address">Favicon (Optional)</label> <br>
                    <input type="file" name="favicon" accept="image/*" onchange="loadFavicon(event)">
                    <img id="outputFavicon" src="{{Storage::disk('uploads')->url($setting->favicon??'noimage.jpg')}}" height="120px" width="140px">
                  </div>
                  
                  
                  <div class="form-group col-sm-12">
                    <label for="map">Google map URL</label>
                    <input type="text" class="form-control" name="map" value="{{$setting->map}}">

                  </div>
                  <div class="form-group col-sm-12">
                    <label for="address">Company description</label>
                    <textarea rows="4" class="form-control" name="description"> {!!$setting->description!!}</textarea>
                  </div>

                  

                  <div class="col-md-12">
                    <p class="text-center p-3">------ SOCIAL MEDIA LINKS ------</p>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="facebook">Facebook link</label>
                    <input type="text" class="form-control" name="facebook" value="{{$setting->facebook}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="instagram">Instagram link</label>
                    <input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="linkedin">Linkedin link</label>
                    <input type="text" class="form-control" name="linkedIn" value="{{$setting->linkedIn}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="twitter">Twitter link</label>
                    <input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="youtube">Youtube link</label>
                    <input type="text" class="form-control" name="youtube" value="{{$setting->youtube}}">
                  </div>
                  {{-- <div class="form-group col-sm-6">
                    <label for="linkedin">Linkedin link</label>
                    <input type="text" class="form-control" name="linkedin" value="{{$setting->linkedin}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> --}}
                    {{-- </div> --}}
                  {{-- </div> --}}
                  {{-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Update</button> &nbsp; &nbsp;
                  <button type="reset" class="btn btn-danger">Reset</button>

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
{{-- <input type="file" accept="image/*" onchange="loadFile(event)">
<img id="output"/> --}}
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
<script>
  var loadFavicon = function(event) {
    var output = document.getElementById('outputFavicon');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endpush