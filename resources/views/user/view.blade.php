@extends('layouts.main')
@section('title') {{ 'User View| '.env('APP_NAME') }} 
@endsection
@push('after-css')
@endpush
@section('content')

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User View</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
					  <th>User Nmae</th>
					  <th>Phone Number</th>
					  <th>City</th>
					  <th>Gender</th>
					  <th>Hobbies</th>
					  <th>Create At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
					  <td>{{$user->id}}</td>
					  <td>{{$user->name}}</td>
					  <td>{{$user->phone_number}}</td>
					  <td>{{$user->city}}</td>
					  <td>{{$user->gender}}</td>
					  <td>{{$user->hobbies}}</td>
					  <td>{{$user->created_at}}</td>
					 </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.control-sidebar -->
</div>

 @endsection
@push('after-js')