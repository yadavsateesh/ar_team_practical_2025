@extends('layouts.main')

@section('title') {{ 'Add Home | '.env('APP_NAME') }} @endsection

@push('after-css')
@endpush
@section('content')
<body class="hold-transition sidebar-mini">
<div class="wrapper"> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @if (Session::get('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success:</h4>{{ Session::get('success') }}
	 </div>
	@endif
	@if (Session::get('danger'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Error!</h4>{{ Session::get('danger') }}
	</div>
	@endif
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	 @if(!empty(auth()->user()->permission_id))
		@if(in_array(2,explode(',',auth()->user()->permission_id)))
		<a type="button" href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>
		@endif
		@endif
        <div class="row">
          <div class="col-12"> 
		  
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User List</h3>
				
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="user_list" class="table table-bordered table-striped">
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection

@push('after-js')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  
   $('#user_list').DataTable({
        processing: true,
        serverSide: true,
       ajax: {
			url: "{{ route('user-list') }}",
			type: 'POST',
		},
       columns: [
		{ data: 'name', title: "Name" },
		{ data: 'email', title: "Email" },
		{ data: 'phone_number', title: "Phone Number" },
		{ data: 'city', title: "City" },
		{ data: 'gender', title: "Gender" },
		{ data: 'hobbies', title: "Hobbies" },
		{ data: 'created_at', title: "Created At" },
		@if(auth()->id() == 1)
		{ 
			data: 'status', 
			title: "Status",
			render: function(data, type, row) {
				var statusClass = data == 1 ? 'btn-success' : 'btn-danger';
				var statusText = data == 1 ? 'Active' : 'Inactive';
				return '<button class="btn ' + statusClass + ' btn-sm status-btn" data-id="' + row.id + '" data-status="' + data + '">' + statusText + '</button>';
			}
		},
		@endif
		{ data: 'action', title: "Action" },
		],
    });

    // Handle status button click
    $(document).on('click', '.status-btn', function() {
        var userId = $(this).data('id');
        var currentStatus = $(this).data('status');
        var newStatus = currentStatus == 1 ? 0 : 1;
        
        $.ajax({
            url: "{{ url('user/status') }}/" + userId,
            type: 'POST',
            data: {
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // Refresh the DataTable
                    $('#user_list').DataTable().ajax.reload();
                } else {
                    alert('Error updating status');
                }
            },
            error: function() {
                alert('Error updating status');
            }
        });
    });

function confirm_click() {
		return confirm('Are you sure you want to delete');
	}
</script>
@endpush
