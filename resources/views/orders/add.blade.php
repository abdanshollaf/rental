@extends('layouts.app.app')
@section('title')
<title>Admin Panel | Orders</title>
@endsection
@section('left-header')
<li class="nav-item">
    <a class="nav-link active">
        <h5>Orders / Order Baru</h5>
    </a>
</li>
@endsection
@include('orders/sidebar')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br />
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 align-content-center">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="card-title">Tambah Order</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('orderstore')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="form-group col-sm-3">
                                    <label for="nama">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Enter Name" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="tipe">Tipe Pelanggan</label>
                                    <select name="tipe" id="tipe" class="form-control" required>
                                        <option value="">-- Select Type --</option>
                                        @foreach ($tipe as $item)
                                        <option value="{{$item->id}}">{{$item->nama_tipe_pelanggan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="telp">No. Telp</label>
                                    <input type="text" class="form-control" id="telp" name="telp"
                                        placeholder="Enter Phone Number" required>
                                </div>
                                <div class="form-group col-sm-9">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Enter Address" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="tgl">Tanggal Lahir</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" id="tgl_lahir" name="tgl_lahir"
                                            class="form-control datetimepicker-input" placeholder="Enter Date Of Birth"
                                            data-toggle="datetimepicker" data-target="#tgl_lahir" />
                                        <div class="input-group-append" data-target="#tgl_lahir"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="alamat">Nama Penumpang</label>
                                    <input type="text" class="form-control" id="pic" name="detail[0][pic]"
                                        placeholder="Enter Passenger Name">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="alamat">No. Hp Penumpang</label>
                                    <input type="text" class="form-control" id="pic" name="detail[0][hp_pic]"
                                        placeholder="Enter Passenger Contact">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="tgl">Tanggal Booking</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" id="start_date" name="detail[0][start_date]"
                                            class="form-control datetimepicker-input" placeholder="Start Date"
                                            data-toggle="datetimepicker" data-target="#start_date" />
                                        <div class="input-group-append" data-target="#start_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                        </div>
                                        <input type="text" id="end_date" name="detail[0][end_date]"
                                            class="form-control datetimepicker-input" placeholder="End Date"
                                            data-toggle="datetimepicker" data-target="#end_date" />
                                        <div class="input-group-append" data-target="#end_date"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="jemput">Alamat Penjemputan</label>
                                    <input type="text" class="form-control" id="jemput" name="detail[0][jemput]"
                                        placeholder="Enter Departure Address">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="tujuan">Tujuan</label>
                                    <input type="text" class="form-control" id="tujuan" name="detail[0][tujuan]"
                                        placeholder="Enter Arrival Address">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="mobil">Tipe Mobil</label>
                                    <select name="detail[0][mobil]" id="mobil" class="form-control">
                                        <option value="">-- Select Car --</option>
                                        @foreach ($mobil as $item)
                                        <option value="{{$item->id}}">{{$item->vendor}} {{$item->no_polisi}} -
                                            {{$item->merk}} {{$item->tipe}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="driver">Driver</label>
                                    <select name="detail[0][driver]" id="driver" class="form-control">
                                        <option value="">-- Select Driver --</option>
                                        @foreach ($driver as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="jam">Jam Booking</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" id="start_time" name="detail[0][start_time]"
                                            class="form-control datetimepicker-input" placeholder="Start Time"
                                            data-toggle="datetimepicker" data-target="#start_time" />
                                        <div class="input-group-append" data-target="#start_time"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                            <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                        </div>
                                        <input type="text" id="end_time" name="detail[0][end_time]"
                                            class="form-control datetimepicker-input" placeholder="End Time"
                                            data-toggle="datetimepicker" data-target="#end_time" />
                                        <div class="input-group-append" data-target="#end_time"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="harga">Harga Sewa</label>
                                    <input type="number" class="form-control" id="harga" name="detail[0][harga]"
                                        placeholder="Enter Price" required>
                                </div>
                            </div>
                            <div class="clone hide" id="rows">
                                <br>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label for="harga">Dibayar</label>
                                    <input type="number" value="0" class="form-control" id="dibayar" name="dibayar"
                                        placeholder="Enter Price">
                                </div>
                                <div class="form-group col-sm-10">
                                    <label for="harga">Note</label>
                                    <input type="text" class="form-control" id="note" name="note"
                                        placeholder="Enter Note">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="container">
                                <div class="float-left">
                                    <a href="{{route('orderindex')}}" class="btn btn-success btn-sm">Back</a>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-secondary btn-sm"><span class="text-white">Add More</span></a>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
<script type="text/javascript">
    var index = 1;
            $(".btn-secondary").click(function(){ 
                var form = '<div class="row form-group"> <div class="form-group col-sm-3"> <label for="alamat">Nama Penumpang</label> <input type="text" class="form-control" id="pic" name="detail['+index+'][pic]" placeholder="Enter Passenger Name"> </div> <div class="form-group col-sm-3"> <label for="alamat">No. Hp Penumpang</label> <input type="text" class="form-control" id="pic" name="detail['+index+'][hp_pic]" placeholder="Enter Passenger Contact"> </div> <div class="form-group col-sm-3"> <label for="mobil">Tipe Mobil</label> <select name="detail['+index+'][mobil]" id="mobil" class="form-control"> <option value="">-- Select Car --</option> @foreach ($mobil as $item) <option value="{{$item->id}}">{{$item->no_polisi}} - {{$item->merk}} {{$item->tipe}}</option> @endforeach </select> </div> <div class="form-group col-sm-3"> <label for="driver">Driver</label> <select name="detail['+index+'][driver]" id="driver" class="form-control"> <option value="">-- Select Driver --</option> @foreach ($driver as $item) <option value="{{$item->id}}">{{$item->nama}}</option> @endforeach </select> </div> <div class="form-group col-sm-3"> <label for="jemput">Alamat Penjemputan</label> <input type="text" class="form-control" id="jemput" name="detail['+index+'][jemput]" placeholder="Enter Departure Address"> </div> <div class="form-group col-sm-3"> <label for="tujuan">Tujuan</label> <input type="text" class="form-control" id="tujuan" name="detail['+index+'][tujuan]" placeholder="Enter Arrival Address"> </div> <div class="form-group col-sm-6"> <label for="tgl">Tanggal Booking</label> <div class="input-group date" data-target-input="nearest"> <input type="text" id="start_date'+index+'" name="detail['+index+'][start_date]" class="start_date form-control datetimepicker-input" placeholder="Start Date" data-toggle="datetimepicker" data-target="#start_date'+index+'"/> <div class="input-group-append" data-target="#start_date'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div> <div class="input-group-text"><i class="fas fa-arrow-right"></i></div> </div> <input type="text" id="end_date'+index+'" name="detail['+index+'][end_date]" class="end_date form-control datetimepicker-input" placeholder="End Date" data-toggle="datetimepicker" data-target="#end_date'+index+'"/> <div class="input-group-append" data-target="#end_date'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div> </div> </div> </div> <div class="form-group col-sm-4"> <label for="jam">Jam Booking</label> <div class="input-group date" data-target-input="nearest"> <input type="text" id="start_time'+index+'" name="detail['+index+'][start_time]" class="start_time form-control datetimepicker-input" placeholder="Start Time" data-toggle="datetimepicker" data-target="#start_time'+index+'"/> <div class="input-group-append" data-target="#start_time'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fas fa-clock"></i></div> <div class="input-group-text"><i class="fas fa-arrow-right"></i></div> </div> <input type="text" id="end_time'+index+'" name="detail['+index+'][end_time]" class="end_time form-control datetimepicker-input" placeholder="End Time" data-toggle="datetimepicker" data-target="#end_time'+index+'"/> <div class="input-group-append" data-target="#end_time'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fas fa-clock"></i></div> </div> </div> </div> <div class="form-group col-sm-3"> <label for="harga">Harga Sewa</label> <input type="number" class="form-control" id="harga'+index+'" name="detail['+index+'][harga]" placeholder="Enter Price" required> </div> <div class="container"> <div class="float-right"> <a class="btn btn-danger btn-sm"><span class="text-white">Remove</span></a> </div> </div> </div>';
                rows.insertAdjacentHTML('beforeend',form);
                $('#start_date' + index).datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#end_date' + index).datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#start_time' + index).datetimepicker({
                    format: 'HH:mm'
                });
                $('#end_time' + index).datetimepicker({
                    format: 'HH:mm'
                });
                console.log('#end_time' + index + '');
                //resetDatePicker();
                ++index;
                //   var html = $(".clone").html();
                //   $(".increment").after(html);
            });

            $(function () {
                $('#tgl_lahir').datetimepicker({
                    format: 'YYYY-MM-DD',
                    viewMode: 'years'
                });
                $('#start_date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#end_date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#start_time').datetimepicker({
                    format: 'HH:mm'
                });
                $('#end_time').datetimepicker({
                    format: 'HH:mm'
                });
            });
            // $(document).ready(function() {

            //     var index = 1;
            //     var rows = document.getElementById("rows");
                

                // function resetDatePicker() {
                //     $('[id^="start_date"]').datetimepicker({
                //         format: 'YYYY-MM-DD',
                //     });
                //     $('[id=^"end_date"]').datetimepicker({
                //         format: 'YYYY-MM-DD',
                //     });
                //     $('[id^="start_time"]').datetimepicker({
                //         format: 'LT',
                //     });
                //     $('[id^="end_time"]').datetimepicker({
                //         format: 'LT',
                //     });
                //     $('[id^="tgl_lahir"]').datetimepicker({
                //         format: 'YYYY-MM-DD',
                //         viewMode: 'years'
                //     });
                // });
              $("body").on("click",".btn-danger",function(){
                  $(this).parents(".form-group").remove();
              });
            //});
        
</script>
@endsection