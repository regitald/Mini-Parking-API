@extends('admin.template.main')
@section('content')

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
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ count($data) }}</h3>

                    <p>New Check-In Car</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-car"></i>
                  </div>
                  <a href="#example1" class="small-box-footer">More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{$today_data}}</h3>

                    <p>Today Complete Transaction</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check"></i>
                  </div> <a href="{{ url('/admin/report-parking') }}" class="small-box-footer">More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$total_data}}</h3>

                    <p>Total Success Transaction</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{ url('/admin/report-parking') }}" class="small-box-footer">More <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <br><hr><br>
        

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
				<div class="row">
						
					<div class="col-md-6">
						<!-- general form elements -->
						<div class="card card-success">
							<div class="card-header">
								<h3 class="card-title">Check In</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form role="form" method="post" action="{{ url('/admin/manage-parking/check-in') }}">
							{{ csrf_field() }}
								<div class="card-body">
									<div class="form-group">
										<label for="plateNumber1">Police Number</label>
										<input type="text" class="form-control"  style="text-transform: uppercase" name ="plate_number" id="plateNumber1"  onkeyup="showMe(this)" placeholder="D 555 A7">
									</div>
                  
									<div class="form-group">
										<label for="plateNumber1">Unique Code</label>
										<input type="text" readonly class="form-control" id="trx_code" name ="trx_code">
									</div>
								</div>
								<!-- /.card-body -->

								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
						<!-- /.card -->

					</div>
					<!-- /.col -->
          <div class="col-md-6">
						<!-- general form elements -->
						<div class="card card-warning">
							<div class="card-header">
								<h3 class="card-title">Check Out</h3>
							</div>
							<!-- /.card-header -->
							<!-- form start -->
							<form role="form" method="post" action="{{ url('/admin/manage-parking/check-out') }}">
							{{ csrf_field() }}
								<div class="card-body">
									<div class="form-group">
										<label for="exampleInputEmail1">Unique Code</label>
										<input type="text" class="form-control"  name ="trx_code" id="exampleInputEmail1" placeholder="D 555 A7">
									</div>
								</div>
								<!-- /.card-body -->

								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
						<!-- /.card -->

					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ongoing Data</h3><br>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Plate Number</th>
                    <th>Trx Code</th>
                    <th>Check-In Time</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($data as $key)
                  <tr>
                    <td>{{$key['plate_number']}}</td>
                    <td>{{$key['trx_code']}}</td>
                    <td>{{$key['checkin_time']}}</td>
                    <td>{{$key['status']}}</td>
                  </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
    function showMe(e) {
      str = e.value;
      var id = "{{$data[0]['id']+1}}"
      str = str.replace(/\D/g, ''); 
      console.log(str);
      document.getElementById("trx_code").value = "ID"+str+"00"+(id);
    }
  </script>
  @endsection