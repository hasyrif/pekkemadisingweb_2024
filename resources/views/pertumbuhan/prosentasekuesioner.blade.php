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
                                    <th>Tanggal</th>
                                    <th> Nama </th>
                                    <th>Benar</th>
                                    <th>Salah</th>
                                    <th>Prosentase</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $record->tanggal }}</td>
                                        <td>{{ $record->nama }}</td>
                                        <td>{{ $record->jawabanbenar }}</td>
                                        <td>{{ $record->jawabansalah }}</td>
                                        <td>{{ $record->prosentase }}</td>
                                    </tr>
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
                    messageTop: 'Rekap Skor Kuesioner'
                }
            ]
        });
    })
</script>

@endsection