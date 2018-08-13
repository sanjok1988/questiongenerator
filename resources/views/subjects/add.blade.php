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
                
            <a onclick="goBack()" class="pull-right"><< Go Back</a>
                <h3 class="box-title">Subjects
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                <a class="btn btn-sm btn-success" href="{{ url('subjects') }}">View List</a>
                            
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('subjects/store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Subject name" >
    
                </div>
                <div class="form-group">
                  <label>Code</label>

                  <input type="text" class="form-control" name="code" placeholder="Code" >
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add New</button>
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
