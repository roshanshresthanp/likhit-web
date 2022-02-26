@extends('backend.layouts.master')
@push('script')
<script>
    $(document).ready(function(){
      $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script> 
@endpush
@push('style')
<style>
.my-custom-scrollbar {
position: relative;
@if($contentType instanceof \Illuminate\Pagination\LengthAwarePaginator )
height: auto;
@else
height: 400px;
@endif
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
   </style> 
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Content type Table</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">content-type</li>
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
                    <div class="card-header">
                    <h3 class="card-title">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-plus mr-2"></i> Add Record
                          </button>
                        {{-- <a class="btn btn-primary" href="{{route('user.create')}}">Add User</a> --}}
                    </h3>
                    <div class="float-right">  <input type="text" name="search" id="search" class="form-control" placeholder="Search"></div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>slug</th>
                                    {{-- <th>Contact</th> --}}
                                    <th style="width: 50px">Action</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($contentType as $key=>$data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->slug}}</td>
                                        {{-- <td>{{$data->contact}}</td> --}}
                                        <td>
                                            <form action="{{route('content-type.destroy',$data->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                {{-- <a href="#" class="fa fa-edit text-dark" title="Edit"> </a> --}}
                                                <button type="submit" class="fas fa-trash btn-light "  title="Delete" onclick="return confirm('Are you sure you want to delete?')" ></button>
                                        
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        @if($contentType instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        Showing {{$contentType->firstItem()}} to {{$contentType->lastItem()	}}
                        of {{$contentType->total()}} entries
                            {{-- <div class="col text-left"> --}}
                            <ul class="pagination pagination-md m-0 d-flex justify-content-center">
                                {!! $contentType->links() !!}
                            </ul>
                            {{-- </div> --}}
                        @else
                            Total entries : {{count($contentType)}}
                        @endif

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Content type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('content-type.store')}}" method="POST">

            <div class="modal-body">
              
                @csrf
                @method('POST')
                    {{-- <label>{{__('Name in English')}}</label> --}}
                    <div class="form-group ">
                <input type="text" class="form-control" placeholder="Enter Content type"
                        name="title" value="{{ old('title') }}" autocomplete="title" autofocus >
                        <p class="text-danger">{{$errors->first('title')}}</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

</div>
@endsection