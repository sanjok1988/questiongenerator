@extends('layouts.app')

@section('content')


   <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User::Edit
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                <a onclick="goBack()" class="pull-right"><< Go Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('users/update')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{old('id', $user->id)}}">
               
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">User Name</label>
                  <input type="text" class="form-control" name="name" value="{{old('name', $user->name)}}" disabled>
    
                </div>
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="text" class="form-control" name="oldPassword" value="{{old('name', $user->password)}}" disabled>
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="text" class="form-control" name="password" value="" >
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="text" class="form-control" name="confirmPassword" value="" >
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
            </form>
          </div>
          <!-- /.box -->         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
