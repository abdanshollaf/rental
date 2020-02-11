@extends('layouts.app.app')
@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Order</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Orders</a></li>
                  <li class="breadcrumb-item active">Edit Order</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
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
                                    <h3 class="card-title">Edit Order</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('orderupdate',$orders[0]->id)}}" method="POST">
                          @csrf
                          <div class="card-body">
                            <div class="row increment form-group">
                                  <div class="form-group col-sm-3">
                                        <label for="nama">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$orders[0]->nama_pelanggan}}" required disabled>
                                  </div>
                                  <div class="form-group col-sm-3">
                                        <label for="tipe">Tipe Pelanggan</label>
                                        <select name="tipe" id="tipe" class="form-control" required disabled>
                                            <option selected="selected" value="{{$orders[0]->id_tipe_pelanggan}}"><?php echo \App\Models\Master\TipePelangganModel::find($orders[0]->id_tipe_pelanggan)->nama_tipe_pelanggan; ?></option>
                                            @foreach ($tipe as $item)
                                                <option value="{{$item->id}}">{{$item->nama_tipe_pelanggan}}</option>
                                            @endforeach
                                        </select>
                                  </div>
                                  <div class="form-group col-sm-3">
                                            <label for="email">Email</label>
                                            <input type="email" disabled class="form-control" id="email" name="email" value="{{$pelanggan[0]->email}}" required>
                                  </div>
                                  <div class="form-group col-sm-3">
                                            <label for="telp">No. Telp</label>
                                            <input type="number" disabled class="form-control" id="telp" name="telp" value="{{$pelanggan[0]->no_telp}}" required>
                                  </div>
                                  <div class="form-group col-sm-9">
                                              <label for="alamat">Alamat</label>
                                              <input type="text" disabled class="form-control" id="alamat" name="alamat" value="{{$pelanggan[0]->alamat}}" required>      
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="tgl">Tanggal Lahir</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" disabled id="tgl_lahir" name="tgl_lahir" value="{{$pelanggan[0]->tgl_lahir}}" class="form-control datetimepicker-input" required/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>  
                                    <br/>
                                    <br/>
                                    @foreach ($orderdetail as $key => $items)
                                        <div class="form-group col-sm-5">
                                            <label for="tgl">Tanggal Booking</label>
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <input type="text" id="start_date" name="detail[{{$key}}][start_date]" value="{{$orderdetail[$key]->start_date}}" class="form-control datetimepicker-input" disabled/>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                                        </div>
                                                        <input type="text" id="end_date" name="detail[{{$key}}][end_date]" value="{{$orderdetail[$key]->finish_date}}" class="form-control datetimepicker-input" disabled/>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>                                                          
                                        </div>
                                        <div class="form-group col-sm-5">
                                            <label for="jam">Jam Booking</label>
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <input type="text" id="start_time" value="{{$orderdetail[$key]->start_time}}" name="detail[{{$key}}][start_time]" class="form-control datetimepicker-input" disabled/>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                                            <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                                        </div>
                                                        <input type="text" id="end_time" value="{{$orderdetail[$key]->finish_time}}" name="detail[{{$key}}][end_time]" class="form-control datetimepicker-input" disabled/>
                                                        <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="input">Total Harga Input</label>
                                            <input type="number" class="form-control" id="input" disabled value="{{$orderdetail[$key]->total_tagihan}}" name="detail[{{$key}}][input]" placeholder="Enter Price" required>
                                        </div> 
                                        <div class="form-group col-sm-2">
                                                    <label for="mobil">Tipe Mobil</label>
                                                    <select name="detail[{{$key}}][mobil]" id="mobil" class="form-control" required>
                                                        <option selected="selected" value="{{$orderdetail[$key]->id_mobil}}"><?php echo \App\Models\Master\MobilModel::find($orderdetail[$key]->id_mobil)->no_polisi; echo " - "; echo \App\Models\Master\MobilModel::find($orderdetail[$key]->id_mobil)->merk; echo " "; echo \App\Models\Master\MobilModel::find($orderdetail[$key]->id_mobil)->tipe; ?></option>
                                                            @foreach ($mobil as $item)
                                                                <option value="{{$item->id}}">{{$item->no_polisi}} - {{$item->merk}} {{$item->tipe}}</option>
                                                            @endforeach
                                                    </select>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="driver">Driver</label>
                                                    <select name="detail[{{$key}}][driver]" id="driver" class="form-control" required>
                                                        <option selected="selected" value="{{$orderdetail[$key]->id_driver}}"><?php echo \App\Models\Master\DriverModel::find($orderdetail[$key]->id_driver)->nama ?></option>
                                                        @foreach ($driver as $item)
                                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                                    <label for="jemput">Alamat Penjemputan</label>
                                                    <input type="text" class="form-control" value="{{$orderdetail[$key]->jemput}}" id="jemput" name="detail[{{$key}}][jemput]" placeholder="Enter Departure Address" required>
                                        </div>
                                        <div class="form-group col-sm-3">
                                                    <label for="tujuan">Tujuan</label>
                                                    <input type="text" class="form-control" value="{{$orderdetail[$key]->tujuan}}" id="tujuan" name="detail[{{$key}}][tujuan]" placeholder="Enter Arrival Address" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="carprice">Biaya Mobil</label>
                                                    <input type="number" class="form-control price{{$key}}" id="carprice" value="{{$orderdetail[$key]->harga_mobil}}" name="detail[{{$key}}][carprice]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="driverprice">Biaya Driver</label>
                                                    <input type="number" class="form-control price{{$key}}" id="driverprice" value="{{$orderdetail[$key]->harga_driver}}" name="detail[{{$key}}][driverprice]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="jalan">Uang Jalan</label>
                                                    <input type="number" class="form-control price{{$key}}" id="jalan" value="{{$orderdetail[$key]->uang_jalan}}" name="detail[{{$key}}][jalan]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="bbm">Bahan Bakar</label>
                                                    <input type="number" class="form-control price{{$key}}" id="bbm" value="{{$orderdetail[$key]->bbm}}" name="detail[{{$key}}][bbm]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="tolparkir">Tol Parkir</label>
                                                    <input type="number" class="form-control price{{$key}}" id="tolparkir" value="{{$orderdetail[$key]->tol_parkir}}" name="detail[{{$key}}][tolparkir]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="makaninap">Makan & Inap</label>
                                                    <input type="number" class="form-control price{{$key}}" id="makaninap" value="{{$orderdetail[$key]->makan_inap}}" name="detail[{{$key}}][makaninap]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="overtime">Overtime</label>
                                                    <input type="number" class="form-control price{{$key}}" id="overtime" value="{{$orderdetail[$key]->overtime}}" name="detail[{{$key}}][overtime]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="titip">Biaya Titip</label>
                                                    <input type="number" class="form-control price{{$key}}" id="titip" value="{{$orderdetail[$key]->biaya_titip}}" name="detail[{{$key}}][titip]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="biaya">Total Biaya</label>
                                                    <input type="number" class="form-control price{{$key}}" id="biaya" value="{{$orderdetail[$key]->total_harga}}" name="detail[{{$key}}][biaya]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="diskon">Diskon</label>
                                                    <input type="number" class="form-control price{{$key}}" id="diskon" value="{{$orderdetail[$key]->diskon}}" name="detail[{{$key}}][diskon]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="ppn">PPN</label>
                                                    <input type="number" class="form-control price{{$key}}" id="ppn" value="{{$orderdetail[$key]->ppn}}" name="detail[{{$key}}][ppn]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="pph">PPH</label>
                                                    <input type="number" class="form-control price{{$key}}" id="pph" value="{{$orderdetail[$key]->pph}}" name="detail[{{$key}}][pph]" placeholder="Enter Price" required>
                                        </div>
                                        <div class="form-group col-sm-2">
                                                    <label for="total_harga">Total Tagihan</label>
                                                    <input type="number" data-key="{{$key}}" class="form-control total_harga{{$key}}" id="total_harga" disabled value="{{$orderdetail[$key]->total_tagihan}}" name="detail[{{$key}}][total_harga]" placeholder="Enter Price" required>
                                        </div> 
                                        <script type="text/javascript">
                                            var index = $(this).data('key');
                                            $(document).on("change", ".price" + index, function() {
                                                var sum = 0;
                                                $(".price" + index).each(function(){
                                                    sum += +$(this).val();
                                                });
                                                $(".total_harga" + index).val(sum);
                                            });
                                        </script>
                                        <br/>
                                    <br/>
                                    <br/>
                                    <br/>  
                                    <br/>
                                    <br/>
                                    @endforeach
                            </div>
                          <!-- /.card-body -->
                          <div class="container">
                              <div class="float-left">
                                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                              </div>
                              <div class="float-right">
                                <a href="{{route('orderindex')}}" class="btn btn-success btn-sm">Back</a>
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
        // var index = 0;
        //     $(document).on("change", ".price" + index, function() {
        //         var sum = 0;
        //         $(".price" + index).each(function(){
        //             sum += +$(this).val();
        //         });
        //         $(".total_harga" + index).val(sum);
        //     });
            // var index = 1;
            // $(".btn-secondary").click(function(){ 
            //     var form = '<div class="row form-group"> <div class="form-group col-sm-3"> <label for="mobil">Tipe Mobil</label> <select name="detail['+index+'][mobil]" id="mobil" class="form-control" required> <option value="">-- Select Car --</option> @foreach ($mobil as $item) <option value="{{$item->id}}">{{$item->no_polisi}} - {{$item->merk}} {{$item->tipe}}</option> @endforeach </select> </div> <div class="form-group col-sm-3"> <label for="driver">Driver</label> <select name="detail['+index+'][driver]" id="driver" class="form-control" required> <option value="">-- Select Driver --</option> @foreach ($driver as $item) <option value="{{$item->id}}">{{$item->nama}}</option> @endforeach </select> </div> <div class="form-group col-sm-3"> <label for="jemput">Alamat Penjemputan</label> <input type="text" class="form-control" id="jemput" name="detail['+index+'][jemput]" placeholder="Enter Departure Address" required> </div> <div class="form-group col-sm-3"> <label for="tujuan">Tujuan</label> <input type="text" class="form-control" id="tujuan" name="detail['+index+'][tujuan]" placeholder="Enter Arrival Address" required> </div> <div class="form-group col-sm-5"> <label for="tgl">Tanggal Booking</label> <div class="input-group date" data-target-input="nearest"> <input type="text" id="start_date'+index+'" name="detail['+index+'][start_date]" class="start_date form-control datetimepicker-input" placeholder="Start Date" data-toggle="datetimepicker" data-target="#start_date'+index+'"/> <div class="input-group-append" data-target="#start_date'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div> <div class="input-group-text"><i class="fas fa-arrow-right"></i></div> </div> <input type="text" id="end_date'+index+'" name="detail['+index+'][end_date]" class="end_date form-control datetimepicker-input" placeholder="End Date" data-toggle="datetimepicker" data-target="#end_date'+index+'"/> <div class="input-group-append" data-target="#end_date'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div> </div> </div> </div> <div class="form-group col-sm-4"> <label for="jam">Jam Booking</label> <div class="input-group date" data-target-input="nearest"> <input type="text" id="start_time'+index+'" name="detail['+index+'][start_time]" class="start_time form-control datetimepicker-input" placeholder="Start Time" data-toggle="datetimepicker" data-target="#start_time'+index+'"/> <div class="input-group-append" data-target="#start_time'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fas fa-clock"></i></div> <div class="input-group-text"><i class="fas fa-arrow-right"></i></div> </div> <input type="text" id="end_time'+index+'" name="detail['+index+'][end_time]" class="end_time form-control datetimepicker-input" placeholder="End Time" data-toggle="datetimepicker" data-target="#end_time'+index+'"/> <div class="input-group-append" data-target="#end_time'+index+'" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fas fa-clock"></i></div> </div> </div> </div> <div class="form-group col-sm-3"> <label for="harga">Harga Sewa</label> <input type="text" class="form-control" id="harga'+index+'" name="detail['+index+'][harga]" placeholder="Enter Price" required> </div> <div class="container"> <div class="float-right"> <a class="btn btn-danger btn-sm"><span class="text-white">Remove</span></a> </div> </div> </div>';
            //     rows.insertAdjacentHTML('beforeend',form);
            //     $('#start_date' + index).datetimepicker({
            //         format: 'YYYY-MM-DD'
            //     });
            //     $('#end_date' + index).datetimepicker({
            //         format: 'YYYY-MM-DD'
            //     });
            //     $('#start_time' + index).datetimepicker({
            //         format: 'LT'
            //     });
            //     $('#end_time' + index).datetimepicker({
            //         format: 'LT'
            //     });
            //     // console.log('#end_time' + index + '');
            //     //resetDatePicker();
            //     ++index;
            //     //   var html = $(".clone").html();
            //     //   $(".increment").after(html);
            // });

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
            //   $("body").on("click",".btn-danger",function(){
            //       $(this).parents(".form-group").remove();
            //   });
            //});
        
        </script>
@endsection