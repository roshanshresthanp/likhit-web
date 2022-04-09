@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="row col-sm-6 d-flex justify-content-between">
            {{-- <h1>Exam Type</h1> --}}
            <button class="btn btn-light">
            <a href="{{ route('widgets') }}"> <span class="fa fa-arrow-left mr-2"></span> BACK</a>
          </button>

            <a class="btn btn-primary" href="{{ route('exams.create') }}"> <span class="fa fa-plus mr-2"></span>Add Exam</a>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">exams</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
        <h5 class="mb-2 mt-4">Exams</h5>
        <div class="row">
          @forelse ($exams as $exam)
          <div class="col-lg-3 col-6">
            <div class="card-info">
              <div class="card-header ">
                {{-- <h3 class="card-title">All together</h3> --}}
  
                <div class="card-tools">
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> --}}
                  <form id="d" action="{{ route('exams.destroy',$exam->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('exams.edit',$exam->id) }}" title="Edit" class="btn btn-tool">
                      <i class="fas fa-edit"></i></a>
                  <button type="submit" title="Delete" onclick="return confirm('Are you sure to delete this record ?')" class="btn btn-tool">
                    <i class="fas fa-times"></i>
                  </button>
                  </form>
                </div>
                <!-- /.card-tools -->
              </div>
            </div>
            
            <div class="small-box bg-light">
              <div class="inner">
                {{-- <p>{{ $exam->title }}</p> --}}

                <h4 class="pt-4 pb-4">{{str_limit($exam->title,12) }}</h4>

              </div>
              <div class="icon">
                <i class="fas"><a href="{{route('exam.subject',$exam->id)}}"><img src="{{ Storage::disk('uploads')->url($exam->featured_img) }}" height="80px" width="85px">
               </a> </i>
              </div>
              <a href="{{route('exam.subject',$exam->id)}}" class="small-box-footer ">
                view detail <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          @empty
          <p class="text-danger">No data found</p>
            
          @endforelse
          
          
          <!-- ./col -->
        </div>
        <!-- =========================================================== -->
      
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
@endsection