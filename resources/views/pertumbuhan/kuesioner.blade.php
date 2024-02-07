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
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>16</th>
                                    <th>17</th>
                                    <th>18</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $record->tanggal }}</td>
                                        <td>{{ $record->nama }}</td>
                                        <td>{{ $record->n1 }}</td>
                                        <td>{{ $record->n2 }}</td>
                                        <td>{{ $record->n3 }}</td>
                                        <td>{{ $record->n4 }}</td>
                                        <td>{{ $record->n5 }}</td>
                                        <td>{{ $record->n6 }}</td>
                                        <td>{{ $record->n7 }}</td>
                                        <td>{{ $record->n8 }}</td>
                                        <td>{{ $record->n9 }}</td>
                                        <td>{{ $record->n10 }}</td>
                                        <td>{{ $record->n11 }}</td>
                                        <td>{{ $record->n12 }}</td>
                                        <td>{{ $record->n13 }}</td>
                                        <td>{{ $record->n14 }}</td>
                                        <td>{{ $record->n15 }}</td>
                                        <td>{{ $record->n16 }}</td>
                                        <td>{{ $record->n17 }}</td>
                                        <td>{{ $record->n18 }}</td>
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
                    messageTop: 'Rekap  Jawaban Quosioner'
                }
            ]
        });
    })
</script>

@endsection