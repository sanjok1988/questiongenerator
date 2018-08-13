@extends('layouts.app')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users</h3>
              <a class="btn btn-success btn-sm pull-right" title="Create New" href="{{ route('register') }}">Register New User</a>
         
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sn.</th>
                  <th>user name</th>
                  <th>Emails</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($users as $data)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$data->name}}
                  </td>
                  <td>{{$data->email}}</td></td>
                  <td>
                  <a class="btn btn-primary btn-sm" title="Edit" href="users/edit/<?php echo $data->id;?>" ><i class="fa fa-pencil"></i> Change Password</a>
                  <a class="btn btn-warning btn-sm" title="Assign Role" href="users/assign/<?php echo $data->id;?>" ><i class="fa fa-user"></i> Assign Role</a>
							    <a title="Delete" class="btn btn-danger btn-sm" href="users/delete/<?php echo $data->id;?>"><i class="fa fa-trash-o"></i></a>
               </td>
                  
                </tr>
                
                @endforeach
                </tfoot>
              </table>
              {!! $users->render() !!}
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
