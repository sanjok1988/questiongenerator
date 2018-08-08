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
                <h3 class="box-title">exams
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                            
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('exams/store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
              <div class="form-group">
              <label>Choose Exam Type</label><br>
                  <select name="exam_type_id">
                  @foreach($exam_types as $data)
                    <option  value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach  
                  </select> 
              </div>
              <div class="form-group">
                <label>Choose Subject</label><br>
                    <select name="subject_id">
                    @foreach($subjects as $data)
                      <option  value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach  
                    </select> 
                </div>
                <div class="form-group">
                  <label for="">Semester</label>
                  <input type="text" class="form-control" name="semester" placeholder="Enter Semester" >
    
                </div>
                <div class="form-group">
                  <label for="">Duration</label>
                  <input type="text" class="form-control" name="duration" placeholder="Enter Duration" >
    
                </div>
                <div class="form-group">
                  <label>Full Mark</label>
                  <input type="text" class="form-control" name="fm" placeholder="Full Mark" >
                </div>
                <div class="form-group">
                  <label>Pass Mark</label>
                  <input type="text" class="form-control" name="pm" placeholder="Pass Mark" >
                </div>
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" class="form-control" name="date" placeholder="Date" >
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
