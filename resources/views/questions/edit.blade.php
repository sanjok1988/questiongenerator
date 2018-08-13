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
                <h3 class="box-title">Question::Edit
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                <a class="btn btn-sm btn-success" href="{{ url('questions') }}">View List</a>  
                <a onclick="goBack()" class="pull-right"><< Go Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{url('questions/update')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{old('id', $question->id)}}">
               
              <div class="box-body">
     
                <div class="form-group">
              <label>Choose Subject</label><br>
                  <select name="subject_id">
                  @foreach($subjects as $data)
                    <option  value="{{$data->id}}" <?php if(old('subject_id', $question->subject_id)== $data->id) echo 'selected="selected"';?>>{{$data->name}}</option>
                  @endforeach  
                  </select> 
              </div>
                <div class="form-group">
                  <label for="">Question Text</label>
                  <input type="text" class="form-control" name="text" placeholder="Enter Question" value="{{old('text', $question->text)}}">
    
                </div>
                <div class="form-group">
                <label>Difficulty Level</label><br>
                <?php 
                  for($i=1; $i<=6; $i++){?>                  
                  <input type="radio" name="diff_level" value="{{$i}}" <?php if(old('diff_level', $question->diff_level)==$i) echo 'checked="checked"';?>> {{$i}}<br>
                  <?php }?>
                  </div>
                <div class="form-group">
                  <label>Mark Assigned</label>
                  <input type="text" class="form-control" name="mark" placeholder="mark" value="{{old('mark', $question->mark)}}" >
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
