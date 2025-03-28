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
            <h1>Update</h1>
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
              <form class="form-horizontal" action="{{ route('user.update',$user->id) }}" method="post">
			  @csrf
				@method('PUT')
                <div class="card-body">
				 <div class="form-group row">
                    <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="{{ $user->name}}" class="form-control" id="inputName3" placeholder="Name">
					   @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>
				   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="{{ $user->email}}" id="inputEmail3" placeholder="Email">
					  @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>
				   <div class="form-group row">
                    <label for="inputPhonenumber3" class="col-sm-2 col-form-label">phone_number</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number}}" id="inputPhonenumber3" placeholder="phone_number">
                    </div>
                  </div>
				  
					<div class="form-group row">
                        <label for="inputCity3" class="col-sm-2 col-form-label">Select City</label>
                        <select class="custom-select" name="city">
                          <option value=""> --Select City-- </option>
						  <option value="surat" {{ $user->city == 'surat' ? 'selected' : '' }}>Surat</option>
						  <option value="navsari"{{ $user->city == 'navsari' ? 'selected' : '' }}>Navsari</option>
						  <option value="vapi" {{ $user->city == 'vapi' ? 'selected' : '' }}>Vapi</option>
                        </select>
						@if ($errors->has('city'))
						<span class="validation" style="color:red;">
							{{ $errors->first('city') }}
						</span>
						@endif
                     </div>
					 
                      <!-- radio -->
                      <div class="form-group row">
					  <label for="inputPassword3" class="col-sm-2 col-form-label">Gender</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" name="gender" value="male" id="customRadio1" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                          <label for="customRadio1" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" name="gender" id="customRadio2"  value="female"{{ $user->gender == 'female' ? 'checked' : '' }}>
                          <label for="customRadio2" class="custom-control-label">Female</label>
                        </div>                        
                      </div>
					  
					   <div class="form-group row">
					    <label for="inputPassword3" class="col-sm-2 col-form-label">Hobbies</label>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox1"  name="hobbies[]" value="boxing"{{ isset($user->hobbies) && in_array('boxing',explode(',',$user->hobbies)) ? 'checked' : '' }}>
                          <label for="customCheckbox1" class="custom-control-label">Boxing</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="hobbies[]" value="cricket" {{ isset($user->hobbies) && in_array('cricket',explode(',',$user->hobbies)) ? 'checked' : '' }} >
                          <label for="customCheckbox2" class="custom-control-label">Cricket</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="hobbies[]"  id="customCheckbox3" value="running"{{ isset($user->hobbies) && in_array('running',explode(',',$user->hobbies)) ? 'checked' : '' }}>
                          <label for="customCheckbox3" class="custom-control-label">Running</label>
                        </div>
                        
                      </div>
					   <div class="form-group row">
					    <label for="inputPermmsions3" class="col-sm-2 col-form-label">Permmsions</label>
						@foreach($permissions as $permission)
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox1{{ $permission->id }}"  name="permission[]" value="{{ $permission->id }}" {{ isset($user->hobbies) && in_array($permission->id,explode(',',$user->permission_id)) ? 'checked' : '' }}>
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