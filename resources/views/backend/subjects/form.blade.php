@extends('backend.layouts.master')

@push('style')
<!-- Select2 -->
{{-- <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}

@endpush
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1><a href="{{route('subjects.index')}}" class="btn btn-info"><span class="fas fa-eye mr-2"></span>View subjects</a></h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">subjects</li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-md-11">   
                    <div class="card">
                           @isset($subject)
                           <h4 class="card-header">Update Subject</h4>
                           <form method="POST" action="{{route('subjects.update',$subject->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                           @else
                           <h4 class="card-header">Add Subject</h4>
                            <form method="POST" action="{{route('subjects.store')}}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            @endisset
                            <div class="card-body row">

                                <div class="form-group col-md-6">
                                <label>Title</label>
                                    <input id="title" type="text" class="form-control"
                                        name="title" value="{{isset($subject)? $subject->title:old('title') }}">
                                        <p style="color: red;">{{ $errors->first('title')}}</p>
                                </div>
                                <div class="form-group col-sm-6 mb-0">
                                    <label for="address">Featured image</label> <br>
                                    <input type="file" class="" name="featured_img" accept="image/*" onchange="loadFavicon(event)">
                                    <img id="outputFavicon" src="{{Storage::disk('uploads')->url($subject->featured_img??'noimage.jpg')}}" height="120px" width="140px">
                                    <p style="color: red;">{{ $errors->first('featured_img')}}</p>
                                </div>

                                {{-- <div class="form-group col-md-6">                    
                                <label> </label>
                                    <input id="office_np" type="text" class="form-control @error('office_np') is-invalid @enderror"
                                        name="office_np" value="{{ old('office_np') }}" required autocomplete="office_np" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                <label>{{__('Location in English')}}</label>
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror"
                                        name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>
                                 </div> --}}
                                    {{-- <div class="form-group col-md-6">                    
                                <label>{{__('Location in Nepali')}}</label>
                                    <input id="location_np" type="text" class="form-control @error('location_np') is-invalid @enderror"
                                        name="location_np" value="{{ old('location_np') }}" required autocomplete="location_np" autofocus>
                                </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('Website')}}</label>
                                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                                                    name="website" value="{{ old('website') }}" required autocomplete="website" autofocus>
                                        </div>
                                        <div class="form-group col-md-6">                    
                                            <label>{{__('Contact No.')}}</label>
                                                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                                                    name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>
                                        </div> --}}

                             {{-- <input type="hidden" name="recaptcha" id="recaptcha"> --}}

                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    
                    </div>
                </div>   
            </div>
        </div>
    </section>
</div>
   
@endsection
@push('script')
{{-- <script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script> --}}
<script>
// $(function () {
//     $('.select2').select2()
// });
var loadFavicon = function(event) {
    var output = document.getElementById('outputFavicon');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endpush