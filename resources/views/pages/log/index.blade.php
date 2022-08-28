@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Log Aktivitas</h4>
                    <div class="table-tools d-flex justify-content-around ">
                        <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data Pengguna ..." id="cari-data-pengguna">
                        <input type="date" class="form-control card-form-header mr-3" id="filter_by_tgl">
                        <button class="btn btn-primary"><a href="{{ URL::to('/yayasan/log_aktivitas') }}" class="text-white"><i class="fas fa-history"></i></a></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>jam Aktivitas</td>
                                <td>Tgl Aktivitas</td>
                                <td>Pengguna</td>
                                <td>Aktivitas</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($log_aktivitas as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->jam_aktivitas }}</td>
                                <td>{{ $row->tgl_aktivitas }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->aktivitas }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('script')
<script>
    $('#filter_by_tgl').on('change',function(){
        let tgl = $(this).val()
        document.location.href = '/yayasan/log_aktivitas/' +tgl;
    })
    $('#liLogAktivitas').addClass('active');
</script>
@endsection
