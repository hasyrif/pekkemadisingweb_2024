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
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Pendidikan</th>
                                    <th>Pekerjaan</th>
                                    <th>Alamat</th>
                                    <th>Nama Balita</th>
                                    <th>Data Balita</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $nomor=1; @endphp 
                                    @foreach ($records as $record)
                                    <tr>
                                        
                                        <td>{{ $nomor }}</td>
                                        <td>{{ $record->nama }}</td>
                                        <td>{{ $record->umur }}</td>
                                        <td>{{ $record->pendidikan }}</td>
                                        <td>{{ $record->pekerjaan }}</td>
                                        <td>{{ $record->alamat }}</td>
                                        <td>{{ $record->nama_balita }}</td>
                                        <td><a href="{{ url('admin/pertumbuhan/balita') }}/{{$record->id}}" class="fas fa-eye-slash"></i></td>
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
                    messageTop: 'Data Ibu'
                }
            ]
        });
    })
</script>

@endsection