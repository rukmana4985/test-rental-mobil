@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="portlet green-sharp box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings"></i>
                    <span class="caption-subject font-white sbold uppercase">{{ $title }}</span>
                    <small>managemen data {{ $title }}</small>
                    
                </div>
                <div class="actions">
                    <a class="btn white btn-outline btn-circle" href="{{ route($view.'.create') }}">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> Add </span>
                    </a>
                </div>
            </div>
            
            <div class="portlet-body">
                <table id="datatable" class="table table-striped table-bordered table-hover table-checkable">
                <thead>
                    <tr>
                        <th>Plat</th>
                        <th>Model</th>
                        <th>Merek</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Berakhir</th>
                        <th>Lama Sewa(Hari)</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $data)
                        <tr>
                            <td>{{$data->plat}}</td>
                            <td>{{$data->model}}</td>
                            <td>{{$data->merk}}</td>
                            
                            @foreach($data->rents as $v)
                                <td>{{$v->date_start}}</td>
                                <td>{{$v->date_end}}</td>
                                <td>{{$v->lama_sewa}} Hari</td>
                                <td>{{$v->price}}</td>  
                            @endforeach
                            <td>
                                @if($data->status == "S")
                                    Belum Dibayar
                                @else
                                    Sudah Beres
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{ route($view.'.store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div>
                                        <input type="hidden" value="{{$data->id}}" name="car_id">
                                        <label for="">Tanggal Bayar</label>
                                        <input type="date" required class="form-control" name="payment_date" id="">
                                    </div>
                                    <br>
                                    <button class="btn btn-primary btn-rounded">Bayar</button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
