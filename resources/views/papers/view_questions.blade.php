@extends('layouts.app')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Questions</h3>
              <a class="btn btn-success btn-sm pull-right" title="Add Questions" href="add?id={{ $_GET['id'] }}&sid={{$_GET['sid']}}"><i class="fa fa-question"></i> Add More Questions</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sn.</th>
                  <th>Questions</th>
                  <th>Difficulty Level</th>
                  <th>Marks</th>
                  <th>Subject</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($questions as $data)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$data->text}}</td>
                  <td>{{$data->diff_level}}</td>
                  <td>{{$data->mark}}</td>
                  <td>{{$data->name}}</td>
                  <td>
				<a title="Delete" class="btn btn-danger btn-sm" href="delete/<?php echo $data->id;?>"><i class="fa fa-trash-o"></i></a>
               </td>
                  
                </tr>
                
                @endforeach
                </tfoot>
              </table>
              {!! $questions->render() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
