@extends('layouts.app')

@section('content')

<?php
$name = "";

if(isset($user[0]))
  $name = $user[0]->name;

  
?>
   <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User::Assign Role
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                <a onclick="goBack()" class="pull-right"><< Go Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('users/update/role')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$id}}">
               
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">User Role</label>
                  <input type="text" class="form-control" name="name" value="{{old('name', $name)}}" disabled>
    
                </div>
                <div class="form-group">
                  <label>Change Role</label><br>
                  <?php 
                  foreach($roles as $role){?>
                    <input type="radio" name="name" value="{{$role->name}}"> {{$role->name}}<br>
                    
                    <?php }?>
                  </div>
                

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
