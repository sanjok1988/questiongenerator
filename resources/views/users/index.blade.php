@extends('layouts.app')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Subjects</h3>
              <a class="btn btn-success btn-sm pull-right" title="Create New" href="subjects/add" ><i class="fa fa-plus"></i> Create New</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sn.</th>
                  <th>Subject</th>
                  <th>Code(s)</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($subjects as $data)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$data->name}}
                  </td>
                  <td>{{$data->code}}</td></td>
                  <td>
                  <a class="btn btn-primary btn-sm" title="Edit" href="subjects/edit/<?php echo $data->id;?>" ><i class="fa fa-pencil"></i></a>
							    <a title="Delete" class="btn btn-danger btn-sm" href="subjects/delete/<?php echo $data->id;?>"><i class="fa fa-trash-o"></i></a>
               </td>
                  
                </tr>
                
                @endforeach
                </tfoot>
              </table>
              {!! $subjects->render() !!}
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
