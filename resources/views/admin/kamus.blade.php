@extends('admin.master')

@section('custom-css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div id="daftar-kosakata" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row pb-4">
                        <div class="col-12">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah-kosakata"><i class="fa fa-plus mr-2"></i>Tambah</button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#lihat-saran"><i class="fa fa-list mr-2"></i>Saran (0)</button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#lihat-request"><i class="fa fa-list mr-2"></i>Request (0)</button>
                            {{-- TAMBAH KOSAKATA --}}
                            <div class="modal fade" id="tambah-kosakata" style="display: none" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Kosakata</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.kamus.add') }}" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aceh</span>
                                                </div>
                                                <input type="text" class="form-control" id="aceh" name="aceh" placeholder="Masukkan kosakata" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Indonesia</span>
                                                </div>
                                                <input type="text" class="form-control" id="indonesia" name="indonesia" placeholder="Masukkan kosakata" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">(Opsional) Deskripsi</span>
                                                </div>
                                                <textarea rows="2" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi"></textarea>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">(Opsional) Gambar</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                    <label class="custom-file-label" for="gambar">Pilih gambar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            {{-- LIHAT SARAN --}}
                            <div class="modal fade" id="lihat-saran" style="display: none" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Daftar Saran Terjemahan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- LIHAT REQUEST --}}
                            <div class="modal fade" id="lihat-request" style="display: none" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Daftar Request Kosakata</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="daftar-kosakata-table" class="table table-bordered table-hover dataTable dtr-inline" role="grid">
                                <thead>
                                    <th>Kategori</th>
                                    <th>Kosakata (Aceh)</th>
                                    <th>Kosakata (Indonesia)</th>
                                    <th class="text-center">Detail</th>
                                    <th class="text-center">Opsi</th>
                                </thead>
                                <tbody>
                                    @foreach ($dictionary as $item)
                                        <tr>
                                            <td>{{ $item->kategori }}</td>
                                            <td style="width: 25%">{{ $item->aceh }}</td>
                                            <td style="width: 30%">{{ $item->indonesia }}</td>
                                            <td class="text-center"><button class="btn btn-sm btn-info">Lihat</button></td>
                                            <td class="text-center">
                                                <button class="btn btn-outline-secondary"><i class="fa fa-edit"></i></button>
                                                <form action="{{ route('admin.kamus.delete', ['dictionaryId' => $item->id]) }}" method="POST" style="display: inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus kosakata ini?')"><i class="fa fa-trash"></i></button>
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
        </div>
    </div>
@endsection

@section('custom-script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $("#daftar-kosakata-table").DataTable();
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
