@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Anggaran masuk</h4>
                    <div class="table-tools d-flex justify-content-around ">
                        <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data Pengguna ..." id="cari-data-pengguna">
                        <select class="custom-select form-control mr-3" id="filter-data-pengguna">
                            <option value="" selected>Filter</option>
                            <option value=""></option>
                        </select>
                        <button type="button" class="btn bg-main text-white float-right" data-toggle="modal" id="addUserBtn" data-target="#modalPengguna"><i class="fas fa-plus"></i></button>
                        @if (auth()->user()->role == 'yayasan')
                        <a href="{{ URL::to('/yayasan/cetak_laporan_anggaran_masuk') }}" type="button" class="btn bg-main text-white float-right ml-3"><i class="fas fa-print"></i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                        <thead>
                            <tr>
                                <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
                                <td>Kode anggaran</td>
                                <td>Nama anggaran</td>
                                <td>Jumlah anggaran</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalAnggaran = 0;
                                ?>
                            @foreach ($jenis_anggaran as $row)
                            <?php
                                $totalAnggaran += $row->jumlah_anggaran;
                            ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kode_anggaran }}</td>
                                    <td>{{ $row->nama_anggaran }}</td>
                                    <td>Rp. {{ number_format($row->jumlah_anggaran) }}</td>
                                    <td>
                                        <button data-edit='@json($row)' data-toggle="modal" data-target="#modalPengguna" class="btn btn-primary edit" href="#"><i class="fas fa-pen"> Edit</i></button>
                                        <button data-id_hapus="{{ $row->id_jenis_anggaran }}" class="btn btn-danger hapus" href="#"><i class="fas fa-trash"> Hapus</i></button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">total anggaran</td>
                                <td> Rp {{ number_format($totalAnggaran) }}</td>
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
                <h5 class="modal-title" id="ModalLabel">Tambah anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="main-body">
                <form id="myForm" action="{{ URL::to('/admin/create_jenis_anggaran') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_anggaran">Kode anggaran</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <input type="text" class="form-control" name="kode_anggaran" id="kode_anggaran">
                    </div>
                    <div class="form-group">
                        <label for="nama_anggaran">Nama anggaran</label>
                        <input type="text" class="form-control" name="nama_anggaran" id="nama_anggaran">
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


        $('.table-user tbody').on('click', 'tr td .edit',function(){
            let dataEdit = $(this).data('edit');
            $('#id').val(dataEdit.id_jenis_anggaran);
            $('#kode_anggaran').val(dataEdit.kode_anggaran);
            $('#nama_anggaran').val(dataEdit.nama_anggaran);
            $('#jumlah_anggaran').val(dataEdit.jumlah_anggaran);
            $('#myForm').attr('action','/admin/update_jenis_anggaran');
        })

        $('#btn-tambah').on('click',function(){
            $('#myForm').attr('action','/admin/create_jenis_anggaran');
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
                        , url: '/admin/delete_jenis_anggaran'
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

    $('#liJenisAnggaran').addClass('active');

</script>
@endsection
