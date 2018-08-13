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
                <h3 class="box-title">Questions
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                <a class="btn btn-sm btn-success" href="{{ url('questions') }}">View List</a>            
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('questions/store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
              <div class="form-group">
              <label>Choose Subject</label><br>
                  <select name="subject_id">
                  @foreach($subjects as $data)
                    <option  value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach  
                  </select> 
              </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Question Text</label>
                  <input type="text" class="form-control" name="text" placeholder="Enter Question" >
    
                </div>
                <div class="form-group">
                <label>Difficulty Level</label><br>
                <?php 
                for($i=1; $i<=6; $i++){?>
                  <input type="radio" name="diff_level" value="{{$i}}"> {{$i}}<br>
                  
                  <?php }?>
                </div>
                <div class="form-group">
                  <label>Mark Assigned</label>
                  <input type="text" class="form-control" name="mark" placeholder="mark" >
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
        <div class="col-md-6">
          <u><H1 style="color:green;font-weight:900">GUIDE</H1></u>
          <img src="{{ asset('images/bloomtaxonomy.png')}}" width="70%"/>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
