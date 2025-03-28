@extends('layouts.main')

@section('title') {{ 'Add Home | '.env('APP_NAME') }} @endsection

@push('after-css')
@endpush
@section('content')
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Horizontal Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('user.store') }}" method="post">
			  @csrf
                <div class="card-body">
				 <div class="form-group row">
                    <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="inputName3" placeholder="Name">
					   @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>
				   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="inputEmail3" placeholder="Email">
					  @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>
				   <div class="form-group row">
                    <label for="inputPhonenumber3" class="col-sm-2 col-form-label">phone_number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" id="inputPhonenumber3" placeholder="phone_number">
                    </div>
                  </div>				  
                
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
				  
					<div class="form-group row">
                        <label for="inputCity3" class="col-sm-2 col-form-label">Select City</label>
                        <select class="custom-select" name="city">
                          <option value="" disabled> --Select City-- </option>
						  <option value="surat">Surat</option>
						  <option value="navsari">Navsari</option>
						  <option value="vapi">Vapi</option>
                        </select>
                     </div>
					 
                      <!-- radio -->
                      <div class="form-group row">
					  <label for="inputPassword3" class="col-sm-2 col-form-label">Gender</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" name="gender" value="male" id="customRadio1">
                          <label for="customRadio1" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" name="gender" value="female" id="customRadio2" checked>
                          <label for="customRadio2" class="custom-control-label">Female</label>
                        </div>                        
                      </div>
					  
					   <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-2 col-form-label">Hobbies</label>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox1"  name="hobbies[]" value="boxing">
                          <label for="customCheckbox1" class="custom-control-label">Boxing</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="hobbies[]" value="cricket" id="customCheckbox2" >
                          <label for="customCheckbox2" class="custom-control-label">Cricket</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="hobbies[]" value="running" id="customCheckbox3">
                          <label for="customCheckbox3" class="custom-control-label">Running</label>
                        </div>
                        
                      </div>
					   <div class="form-group row">
					    <label for="inputPermmsions3" class="col-sm-2 col-form-label">Permmsions</label>
						@foreach($permissions as $permission)
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox1{{ $permission->id }}"  name="permission[]" value="{{ $permission->id }}">
						  <label class="custom-control-label" for="customCheckbox1{{ $permission->id }}">
						  {{ $permission->permission }}
						  </label>
                        </div> 
						@endforeach
						@if ($errors->has('permission'))
						<span class="validation" style="color:red;">
							{{ $errors->first('permission') }}
						</span>
						@endif
                      </div>					  
                    </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.control-sidebar -->
</div>
@endsection
@push('after-js')
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endpush