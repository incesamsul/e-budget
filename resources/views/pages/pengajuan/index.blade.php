@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Anggaran tersedia</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover table-user table-action-hover">
                        <thead>
                            <tr>
                                <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
                                <td>Kode anggaran</td>
                                <td>Nama anggaran</td>
                                <td>jumlah anggaran</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_anggaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kode_anggaran }}</td>
                                    <td>{{ $row->nama_anggaran }}</td>
                                    <td>{{ 'Rp' . number_format($row->jumlah_anggaran) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Pengajuan</h4>
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
                                <td>jumlah anggaran</td>
                                <td>alasan ditolak bendahara</td>
                                <td>alasan ditolak ketua</td>
                                <td>status</td>
                                <td>keterangan</td>
                                <td>tgl pencairan</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>{{ $row->jenisAnggaran->kode_anggaran }}</td>
                                    <td>{{ $row->jenisAnggaran->nama_anggaran }}</td>
                                    <td> Rp. {{ number_format($row->jumlah_anggaran) }}</td>
                                    <td>{{ $row->alasan_bendahara_tolak == null ? 'none' : $row->alasan_bendahara_tolak }}</td>
                                    <td>{{ $row->alasan_ketua_tolak == null ? 'none' : $row->alasan_ketua_tolak }}</td>
                                    <td>
                                        {!! getStatus($row) !!}
                                    </td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>{{ $row->tgl_pencairan == null ? 'none' : $row->tgl_pencairan }}</td>
                                    <td>
                                        <button data-edit='@json($row)' data-toggle="modal" data-target="#modalPengguna" class="btn btn-primary edit" href="#"><i class="fas fa-pen"> Edit</i></button>
                                        <button data-id_hapus="{{ $row->id_pengajuan }}" class="btn btn-danger hapus" href="#"><i class="fas fa-trash"> Hapus</i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
                <form id="myForm" action="{{ URL::to('/pengaju/create_pengajuan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Jenis anggaran</label>
                        <select class="form-control" name="id_jenis_anggaran" id="id_jenis_anggaran">
                            <option value="">-- jenis anggaran -- </option>
                            @foreach ($jenis_anggaran as $row)
                            <option value="{{ $row->id_jenis_anggaran }}">{{ $row->nama_anggaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_anggaran">Jumlah anggaran</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="jumlah_anggaran" id="jumlah_anggaran">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">keterangan anggaran</label>
                        <textarea class="form-control my-textarea" name="keterangan" id="keterangan"></textarea>
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

        $('.table-user tbody').on('click', 'tr td .edit',function(){
            let dataEdit = $(this).data('edit');
            $('#id').val(dataEdit.id_pengajuan);
            $('#jumlah_anggaran').val(dataEdit.jumlah_anggaran);
            $('#keterangan').val(dataEdit.keterangan);
            $('#id_jenis_anggaran').val(dataEdit.id_jenis_anggaran);
            $('#myForm').attr('action','/pengaju/update_pengajuan');
        })

        $('#btn-tambah').on('click',function(){
            $('#myForm').attr('action','/pengaju/create_pengajuan');
        });


        $('.table-user tbody').on('click', 'tr td .hapus', function() {
            let id_anggaran = $(this).data('id_hapus');
            Swal.fire({
                title: 'Apakah yakin?'
                , text: "Data tidak bisa kembali lagi!"
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
                        , url: '/pengaju/delete_pengajuan'
                        , method: 'post'
                        , dataType: 'json'
                        , data: {
                            id: id_anggaran
                        }
                        , success: function(data) {
                            if (data == 1) {
                                Swal.fire('Berhasil', 'Data telah terhapus', 'success').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            })
        });





    });

    $('#liPengajuan').addClass('active');

</script>
@endsection
