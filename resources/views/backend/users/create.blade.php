@extends('backend.layouts.master')

@push('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}

@endpush
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1><a href="{{route('user.index')}}" class="btn btn-info"><span class="fas fa-eye mr-2"></span>View Users</a></h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                        <h4 class="card-header">Add New User </h4>
                           
                        <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body row">
                                <div class="form-group col-md-6">
                                  <label>Minimal</label>
                                  <select class="select2 form-control" style="width:100%;">
                                    <option >Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option selected="selected">Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                  </select>
                                </div>

                                <div class="form-group col-md-6">
                                <label>{{__('Name in English')}}</label>
                                    <input id="office" type="text" class="form-control @error('office') is-invalid @enderror"
                                        name="office" value="{{ old('office') }}" required autocomplete="office" autofocus>
                                </div>
                                <div class="form-group col-md-6">                    
                                <label>{{__('Name in Nepali')}}</label>
                                    <input id="office_np" type="text" class="form-control @error('office_np') is-invalid @enderror"
                                        name="office_np" value="{{ old('office_np') }}" required autocomplete="office_np" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                <label>{{__('Location in English')}}</label>
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror"
                                        name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>
                                 </div>
                                    <div class="form-group col-md-6">                    
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
                                        </div>

                             {{-- <input type="hidden" name="recaptcha" id="recaptcha"> --}}

                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button> &nbsp; &nbsp;
                                <button type="reset" class="btn btn-danger">Reset</button>
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
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});

// $('.select2bs4').select2({
//       theme: 'bootstrap4'
//     });
</script>
@endpush