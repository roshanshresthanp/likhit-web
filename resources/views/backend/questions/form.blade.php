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
                <h1><a href="{{route('questions.index')}}" class="btn btn-info"><span class="fas fa-eye mr-2"></span>View Q&A</a></h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">questions</li>
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
                           @isset($question)
                           <h4 class="card-header">Update Exam type </h4>

                           <form method="POST" action="{{route('questions.update',$question->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                           @else
                           <h4 class="card-header">Add Question & Answer</h4>
                        <form method="POST" action="{{route('questions.store')}}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            @endisset

                            <div class="card-body row">

                                {{-- <div class="form-group col-md-6">
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
                                </div> --}}

                                <div class="form-group col-md-6">
                                    <label>Select Exam</label>
                                        <select id="question"class="form-control" name="exam_id">
                                            @foreach ($exams as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color: red;">{{ $errors->first('exam_id')}}</p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Select Subject</label>
                                        <select id="subject_id"class="form-control" name="subject_id">
                                            @foreach ($subjects as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        <p style="color: red;">{{ $errors->first('subject_id')}}</p>
                                </div>

                                <div class="form-group col-md-12">
                                <label>Question</label>
                                    <input id="question" type="text" class="form-control"
                                        name="question" value="{{isset($question)? $question->question:old('question') }}">
                                        <p style="color: red;">{{ $errors->first('question')}}</p>
                                </div>
                                {{-- <div class="form-group col-sm-6 mb-0">
                                    <label for="address">Featured image</label> <br>
                                    <input type="file" class="" name="featured_img" accept="image/*" onchange="loadFavicon(event)">
                                    <img id="outputFavicon" src="{{Storage::disk('uploads')->url($question->featured_img??'noimage.jpg')}}" height="120px" width="140px">
                                    <p style="color: red;">{{ $errors->first('featured_img')}}</p>
                                </div> --}}
                                <label class="col-12">Answers</label>

                                <div class="row">
                                <div class="form-group col-md-3">
                                    <input id="answer" type="text" class="form-control"
                                        name="right_answer" value="{{isset($question)? $question->right_answer:old('right_answer') }}" placeholder="1. Right Answer">
                                        <p style="color: red;">{{ $errors->first('right_answer')}}</p>
                                </div>
                                <div class="form-group col-md-3">
                                        <input id="answer" type="text" class="form-control"
                                            name="answer[]" value="{{isset($question)? $question->answer:old('right_answer') }}" placeholder="2. Answer">
                                            <p style="color: red;">{{ $errors->first('answer')}}</p>
                                </div>
                                <div class="form-group col-md-3">
                                    <input id="answer" type="text" class="form-control"
                                        name="answer[]" value="{{isset($question)? $question->answer:old('right_answer') }}" placeholder="3. Answer">
                                        <p style="color: red;">{{ $errors->first('answer')}}</p>
                            </div>
                            <div class="form-group col-md-3">
                                <input id="answer" type="text" class="form-control"
                                    name="answer[]" value="{{isset($question)? $question->answer:old('right_answer') }}" placeholder="4. Answer">
                                    <p style="color: red;">{{ $errors->first('answer')}}</p>
                            </div>
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
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});

  var loadFavicon = function(event) {
    var output = document.getElementById('outputFavicon');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
// $('.select2bs4').select2({
//       theme: 'bootstrap4'
//     });
</script>
@endpush