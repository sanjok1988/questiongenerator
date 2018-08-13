@extends('layouts.app')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Questions To Exams</h3>
              <a class="btn btn-success btn-sm pull-right" title="Create New" href="exams/add" ><i class="fa fa-plus"></i> Create New Exam</a>
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
                  <th>Date</th>              
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($exams as $data)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$data->exam_type}}</td>
                  <td>{{$data->semester}}</td>
                  <td>{{$data->subject}}</td>
                  <td>{{$data->date}}</td>
                
                  <td>
                  <a class="btn btn-warning btn-sm" title="Add Questions" href="papers/add?id={{ $data->eid }}&sid={{$data->sid}}"><i class="fa fa-question"></i> <i class="fa fa-plus"></i></a>
                  <a class="btn btn-success btn-sm" title="View Questions" href="papers/view?id={{ $data->eid }}&sid={{$data->sid}}"><i class="fa fa-eye"></i></a>		
                  <a class="btn btn-primary btn-sm" title="Generate Paper" href="papers/export/{{  $data->eid }}/{{$data->sid}}/{{$data->semester}}" ><i class="fa fa-file"></i></a>						    
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
