@extends('backend.layouts.master')
@push('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> 
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Users Table</h1>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                    <h3 class="card-title"><a class="btn btn-primary" href="{{route('user.create')}}"><i class="fas fa-plus mr-2"></i>Add User</a>
                    </h3>
                    <div class="float-right">  <input type="text" name="search" id="search" class="form-control" placeholder="Search"></div>

                    </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    {{-- <th style="width: 10px">#</th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key=>$user)
                                    <tr>
                                        {{-- <td>{{$key+1}}</td> --}}
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->contact}}</td>
                                        <td>
                                            <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="fa fa-edit text-dark" title="Edit"> </a>
                                                <button type="submit" class="fas fa-trash btn-light float-right"  title="Delete" onclick="return confirm('Are you sure you want to delete?')" ></button>
                                        
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</div>
@endsection
@push('script')
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script> 
 <script>
    $(function () {
      $('#example2').DataTable({
        "responsive": true,
      });
    });
  </script>
<script>


    $(document).ready(function(){
      $("#search").on("input", function() {
        // var value = $(this).val().toLowerCase();
        var search = this.value;
        // alert(search);
        $.ajax({
            method : "get",
            data : {search:search},
            url :"{{route('user.index')}}",
            success: function(response){
                // console.log(response);
                $("#myTable").replaceWith(response);
            },
            
        });

        // $("#myTable tr").filter(function() {
        //   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        // });


      });
    });
    </script> 
@endpush