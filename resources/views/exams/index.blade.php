@extends('layouts.app')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Exams</h3>
              <a class="btn btn-success btn-sm pull-right" title="Create New" href="exams/add" ><i class="fa fa-plus"></i> Create New</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sn.</th>
                  <th>exam_type</th>
                  <th>semester</th>
                  <th>subject</th>
                  <th>duration</th>
                  <th>date</th>
                  <th>Full Mark</th>
                  <th>Pass Mark</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($exams as $data)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->semester}}</td>
                  <td>{{$data->subject_id}}</td>
                  <td>{{$data->duration}}</td>
                  <td>{{$data->date}}</td>
                  <td>{{$data->fm}}</td>
                  <td>{{$data->pm}}</td>
                  <td>
                  <a class="btn btn-primary btn-sm" title="Edit" href="exams/edit/<?php echo $data->id;?>" ><i class="fa fa-pencil"></i></a>
							    <a title="Delete" class="btn btn-danger btn-sm" href="exams/delete/<?php echo $data->id;?>"><i class="fa fa-trash-o"></i></a>
               </td>
                  
                </tr>
                
                @endforeach
                </tfoot>
              </table>
              {!! $exams->render() !!}
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
