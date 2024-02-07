<?PHP
use App\myclass\Helper;
?>
@extends('layouts.app2')
@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rekap Kuesioner</h3>
                        </div>    
                    <div class="card-body">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Ibu</th>
                                    <th>Nama Balita</th>
                                    <th>Tgl Input</th>
                                    <th>Usia (Bulan)</th>
                                    <th>Brt Badan</th>
                                    <th>Status</th>
                                    <th>Anjuran</th>
                                    <th>Tgi Badan</th>
                                    <th>Status</th>
                                    <th>Anjuran</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $nomor=1;
                                    $helper=new Helper();
                                    @endphp 
                                    @foreach ($records as $record)
                                    <tr>
                                        
                                        <td>{{ $nomor }}</td>
                                        <td>{{ $record->nama }}</td>
                                        <td>{{ $record->nama_balita }}</td>
                                        <td>{{ $record->tanggalinput }}</td>
                                        @php $usiabalita=$helper->selisihbulan($record->tanggallahir,$record->tanggalinput); @endphp
                                        <td>{{ $usiabalita }}</td>
                                        <td>{{ $record->beratbadan }}</td>
                                        <td>{{ $record->statusberatbadan }}</td>
                                        <td>{{ $record->anjuranberatbadan }}</td>
                                        <td>{{ $record->panjangbadan }}</td>
                                        <td>{{ $record->statuspanjangbadan }}</td>
                                        <td>{{ $record->anjuranpanjangbadan }}</td>
                                    </tr>
                                    @php $nomor++ @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascripts')
<script> 
    $ ( function () {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    messageTop: 'Data Status Pertumbuhan'
                }
            ]
        });
    })
</script>

@endsection