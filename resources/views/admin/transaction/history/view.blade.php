@extends('admin.template.main')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            
            @if (Session::has('success'))
              <div class="alert alert-success">
                {{Session::get('success')}}
                </div>
            @endif
				<!-- /.row -->
        <div class="card">
          
      <div class="row">	
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-dafault">
            <div class="card-header">
              <h3 class="card-title">Filter Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ url('/admin/report-parking/filter') }}">
            {{ csrf_field() }}
              <div class="card-body">
                <div class="row">
                    <div class="col-4">
                      <b>Check In Time</b>
                      <input type="date" class="form-control" name="start_date">
                    </div>
                    <div class="col-4">
                      <b>Check Out Time</b>
                      <input type="date" class="form-control" name="end_date">
                    </div>
                    
                    <div class="col-4">
                      <br>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->

            </form>
          </div>
          <!-- /.card -->

        </div>
      </div>
              <div class="card-header">
                <h3 class="card-title">History Data</h3><br>
              <!-- /.card-header -->
              <div class="card-body">
                
              <table id="withexport" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Trx Code</th>
                    <th>Plate Number</th>
                    <th>Check-In Time</th>
                    <th>Check-Out Time</th>
                    <th>Total Price</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($data as $key)
                  <tr>
                    <td>{{$key['trx_code']}}</td>
                    <td>{{$key['plate_number']}}</td>
                    <td>{{$key['checkin_time']}}</td>
                    <td>{{$key['checkout_time']}}</td>
                    <td>{{$key['price_total']}}</td>
                    <td>{{$key['status']}}</td>
                  </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection