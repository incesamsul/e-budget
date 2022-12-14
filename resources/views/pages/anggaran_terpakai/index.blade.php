@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Anggaran terpakai</h4>
                    <div class="table-tools d-flex justify-content-around ">
                        <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data Pengguna ..." id="cari-data-pengguna">
                        <select class="custom-select form-control mr-3" id="filter-data-pengguna">
                            <option value="" selected>Filter</option>
                            <option value=""></option>
                        </select>
                        <button type="button" class="btn bg-main text-white float-right" data-toggle="modal" id="addUserBtn" data-target="#modalPengguna"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                        <thead>
                            <tr>
                                <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
                                <td>hari / tgl</td>
                                <td>kode anggaran</td>
                                <td>jenis anggaran</td>
                                <td>nominal ajuan</td>
                                <td>Keterangan</td>
                                <td>status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalNominal = 0;
                                ?>
                            @foreach ($pengajuan as $row)
                            <?php
                            $totalNominal += $row->jumlah_anggaran;
                            ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>{{ $row->jenisAnggaran->kode_anggaran }}</td>
                                    <td>{{ $row->jenisAnggaran->nama_anggaran }}</td>
                                    <td>{{ 'Rp. ' . number_format($row->jumlah_anggaran) }}</td>
                                    <td>{{ $row->keterangan == null ? 'none' : $row->keterangan }}</td>
                                    <td>
                                        {!! getStatus($row) !!}
                                    </td>
                                    </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">total</td>
                                <td>Rp. {{ number_format($totalNominal) }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="modalPengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Tambah Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="main-body">
                <form id="formPengajuan" action="{{ URL::to('/pengaju/create_pengajuan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Jenis anggaran</label>
                        <select class="form-control" name="id_jenis_anggaran" id="id_jenis_anggaran">
                            <option value="">-- jenis anggaran -- </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_anggaran">Jumlah anggaran</label>
                        <input type="text" class="form-control" name="jumlah_anggaran" id="jumlah_anggaran">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn bg-main text-white" id="modalBtn">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {



        $('.table-user tbody').on('click', 'tr td a.terima', function() {
            let id = $(this).data('id');
            console.log(id);
            Swal.fire({
                title: 'Apakah yakin?'
                , text: "data akan tersimpan!"
                , type: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Konfirmasi'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , url: '/bendahara/terima_pengajuan'
                        , method: 'post'
                        , dataType: 'json'
                        , data: {
                            id: id
                        }
                        , success: function(data) {
                            if (data == 1) {
                                Swal.fire('Berhasil', 'Data akan terupdate', 'success').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            })
        });

        $('.table-user tbody').on('click', 'tr td a.tolak', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah yakin?'
                , text: "data akan tersimpan!"
                , type: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Konfirmasi'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , url: '/bendahara/tolak_pengajuan'
                        , method: 'post'
                        , dataType: 'json'
                        , data: {
                            id: id
                        }
                        , success: function(data) {
                            if (data == 1) {
                                Swal.fire('Berhasil', 'Data akan terupdate', 'success').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            })
        });





    });

    $('#liAnggaranTerpakai').addClass('active');

</script>
@endsection
