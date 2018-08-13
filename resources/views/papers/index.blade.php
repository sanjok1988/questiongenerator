@extends('layouts.app')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Questions</h3>
              <a class="btn btn-success btn-sm pull-right" title="Create New" href="questions/add" ><i class="fa fa-plus"></i> Create New Question</a>
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
                  <a class="btn btn-primary btn-sm" title="Edit" href="questions/edit/<?php echo $data->id;?>" ><i class="fa fa-pencil"></i></a>
							    <a title="Delete" class="btn btn-danger btn-sm" href="questions/delete/<?php echo $data->id;?>"><i class="fa fa-trash-o"></i></a>
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
