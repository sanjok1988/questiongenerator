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
                <h3 class="box-title">Add Questions To Exam Paper
                    @if ($errors->any())
                        <span>{!! implode('', $errors->all('<i style="color:red">:message</i>')) !!}</span>
                    @endif
                </h3>
                            
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php 
               $id=$sid="";
                if(isset($_GET['id'])) 
                  $id = $_GET['id'];

                if(isset($_GET['sid'])) 
                  $sid = $_GET['sid']; 
            ?>
            <form role="form" method="POST" action="{{url('papers/generate')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="exam_id" value="{{$id}}">
            <input type="hidden" name="subject_id" value="{{$sid}}">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="">Choose Number Of Questons</label>
                  <input type="number" class="form-control" name="noOfQuestions" placeholder="No. Of Questions" required>
    
                </div>
                <div class="form-group">
                <label>Difficulty Level</label><br>
                  <input type="radio" name="diff_level" value="easy"> Easy<br>
                  <input type="radio" name="diff_level" value="normal"> Normal<br>
                  <input type="radio" name="diff_level" value="difficult"> Difficult
                </div>
                {{--  <div class="form-group">
                  <label>Total Mark for Questions</label>
                  <input type="text" class="form-control" name="mark" placeholder="mark" >
                </div>  --}}
               
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
