@extends('layout.layout')

@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List Orders</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card">
                                        <h5 class="card-header"><a href="javascript:filters()"><i class="fa fa-filter">  FILTERS</i></a></h5>
                                        <div class="card-body" id="filter" style="display: none;">
                                            {!! Form::open(['action'=>['App\Http\Controllers\orderingController@filter'],'method'=>'POST']) !!}
                                            <div class="row pb-2">
                                                <div class="col-md-6 ">
                                                    <label>Date</label>
                                                    <select class="form-control" id="select">
                                                        <option value="0">Select date filter</option>
                                                        <option value="1">From - To</option>
                                                        <option value="2">Greater Or Equals</option>
                                                        <option value="3">Less Or Equals</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row pb-2" id="fromto">
                                                <div class="col-md-3 ">
                                                    <label>From</label>
                                                        <input id="from" type="date" name="from" class="form-control">
                                                </div>
                                                <div class="col-md-3 ">
                                                    <label>To</label>
                                                        <input id="to" type="date" name="to" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row pb-2" id="less">
                                                <div class="col-md-3 ">
                                                    <label>Less than or Equal</label>
                                                    <input id="lessdate" type="date" name="less" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row pb-2" id="great">
                                                <div class="col-md-3 ">
                                                    <label>Greater than or Equal</label>
                                                    <input id="greatdate" type="date" name="great" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2 ">
                                                <button id="filterbtn" class="btn btn-secondary"><i class="fa fa-filter"> Filter </i></button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>CustomerID</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($data))
                                        @foreach($data as $d)
                                        <tr>
                                            <td>{{$d['id']}}</td>
                                            <td>{{$d['customerId']}}</td>
                                            <td>{{$d['createdAt']}}</td>
                                            <td><a href="{{route('vieworder',['id' =>$d['id']])}}"> <i class="fas fa-eye"> </i> View Order</a> </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        @foreach($search as $s)
                                            <tr>
                                                <td>{{$s['id']}}</td>
                                                <td>{{$s['customerId']}}</td>
                                                <td>{{$s['createdAt']}}</td>
                                                <td><a href="{{route('vieworder',['id' =>$s['id']])}}"> <i class="fas fa-eye"> </i> View Order</a> </td>
                                            </tr>
                                        @endforeach

                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('customscript')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $( "#fromto").hide();
        $( "#great").hide();
        $( "#less").hide();
        $( "#filterbtn").hide();
        $('#select').change(function(){
            var value = $(this).val();
            if(value == 1){
                $( "#fromto").show();
                $( "#filterbtn").show();
                $( "#great").hide();
                $( "#less").hide();
                $( "#lessdate").val("");
                $( "#greatdate").val("");

            }
            else if(value == 2){
                $( "#great").show();
                $( "#filterbtn").show();
                $( "#fromto").hide();
                $( "#less").hide();
                $( "#from").val("");
                $( "#to").val("");
                $( "#lessdate").val("");

            }
            else if(value == 3){
                $( "#less").show();
                $( "#filterbtn").show();
                $( "#great").hide();
                $( "#fromto").hide();
                $( "#from").val("");
                $( "#to").val("");
                $( "#greatdate").val("");
            }
        });

        $('#orders').addClass('active');
        function filters() {
            $( "#filter" ).toggle( "slow" );
        }
    </script>
@endsection
