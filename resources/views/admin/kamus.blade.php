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
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#lihat-saran"><i class="fa fa-list mr-2"></i>Saran ({{ $vocabularySuggestions->count() }})</button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#lihat-request"><i class="fa fa-list mr-2"></i>Request ({{ $vocabularyRequests->count() }})</button>

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

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">(Opsional) Audio</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="audio" name="audio">
                                                    <label class="custom-file-label" for="audio">Pilih audio</label>
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

                            {{-- EDIT KOSAKATA --}}
                            <div class="modal fade" id="edit-kosakata" style="display: none" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Kosakata</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data" id="edit-kosakata-form">
                                        <div class="modal-body">
                                            @method('PATCH')
                                            @csrf
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Aceh</span>
                                                </div>
                                                <input type="text" class="form-control" id="edit-aceh" name="aceh" placeholder="Masukkan kosakata" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Indonesia</span>
                                                </div>
                                                <input type="text" class="form-control" id="edit-indonesia" name="indonesia" placeholder="Masukkan kosakata" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">(Opsional) Deskripsi</span>
                                                </div>
                                                <textarea rows="2" class="form-control" id="edit-deskripsi" name="deskripsi" placeholder="Masukkan deskripsi"></textarea>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">(Opsional) Gambar</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="edit-gambar" name="gambar">
                                                    <label class="custom-file-label" for="edit-gambar">Pilih gambar</label>
                                                </div>
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">(Opsional) Audio</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="edit-audio" name="audio">
                                                    <label class="custom-file-label" for="edit-audio">Pilih audio</label>
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
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Daftar Saran Terjemahan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered table-striped" id="lihat-saran-table">
                                                <thead>
                                                    <tr>
                                                        <th>Kosakata (Aceh)</th>
                                                        <th>Kosakata (Indonesia)</th>
                                                        <th>Deskripsi</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($vocabularySuggestions as $vocabularySuggestion)
                                                        <tr>
                                                            {{-- <td>{{ date('d/m/Y H:i', (int)($vocabularySuggestion->createdAt)) }}</td> --}}
                                                            <td>{{ $vocabularySuggestion->aceh }}</td>
                                                            <td>{{ $vocabularySuggestion->indonesia }}</td>
                                                            <td>{{ $vocabularySuggestion->deskripsi }}</td>
                                                            <td>
                                                                <button class="btn btn-sm btn-primary mb-1" onclick="editDanTerimaSaran('{{ $vocabularySuggestion->aceh }}', '{{ $vocabularySuggestion->indonesia }}', '{{ isset($vocabularySuggestion->deskripsi) ? $vocabularySuggestion->deskripsi : '-' }}')">Edit & Terima</button>
                                                                <form action="{{ route('admin.kamus.terima-saran', ['id' => $vocabularySuggestion->id]) }}" method="POST" style="display: inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-secondary mb-1">Terima</button>
                                                                </form>
                                                                <form action="{{ route('admin.kamus.tolak-saran', ['id' => $vocabularySuggestion->id]) }}" method="POST" style="display: inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger mb-1">Tolak</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
                                            <table class="table table-bordered table-striped" id="lihat-request-table">
                                                <thead>
                                                    <tr>
                                                        <th>Kosakata</th>
                                                        <th>Sediakan Terjemahan kedalam Bahasa</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($vocabularyRequests as $vocabularyRequest)
                                                        <tr>
                                                            {{-- <td>{{ date('d/m/Y H:i', (int)($vocabularyRequest->createdAt)) }}</td> --}}
                                                            <td>{{ $vocabularyRequest->kosakata }}</td>
                                                            <td>{{ ucfirst($vocabularyRequest->bahasa_tujuan) }}</td>
                                                            <td>
                                                                <button class="btn btn-sm btn-primary mb-1" onclick="sediakanTerjemahan('{{ $vocabularyRequest->kosakata }}', '{{ $vocabularyRequest->bahasa_tujuan }}')">Sediakan</button>
                                                                <form action="{{ route('admin.kamus.abaikan-request', ['id' => $vocabularyRequest->id]) }}" method="POST" style="display: inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger mb-1">Abaikan</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- LIHAT DETAIL KOSAKATA --}}
                            <div class="modal fade" id="lihat-detail-kosakata" style="display: none" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Detail Kosakata</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td style="width: 38%">Kosakata (Aceh)</td>
                                                    <td id="detail-kosakata-aceh"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 38%">Kosakata (Indonesia)</td>
                                                    <td id="detail-kosakata-indonesia"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 38%">Deskripsi</td>
                                                    <td id="detail-deskripsi"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 38%">Gambar</td>
                                                    <td id="detail-gambar"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 38%">Audio</td>
                                                    <td id="detail-audio"></td>
                                                </tr>
                                            </table>
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
                                            <td class="text-center"><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#lihat-detail-kosakata" onclick="viewDetail('{{ $item->aceh }}', '{{ $item->indonesia }}', '{{ isset($item->deskripsi) ? $item->deskripsi : '-' }}', '{{ isset($item->gambar) ? $item->gambar : '-' }}', '{{ isset($item->audio) ? $item->audio : '-' }}')">Lihat</button></td>
                                            <td class="text-center">
                                                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#edit-kosakata" onclick="editKosakata('{{ $item->id }}', '{{ $item->aceh }}', '{{ $item->indonesia }}', '{{ isset($item->deskripsi) ? $item->deskripsi : '-' }}')"><i class="fa fa-edit"></i></button>
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
        $("#lihat-saran-table").DataTable();
        $("#lihat-request-table").DataTable();

        $(function () {
            bsCustomFileInput.init();
        });

        function viewDetail (kosakataAceh, kosakataIndonesia, deskripsi, gambar, audio) {
            $("#detail-kosakata-aceh").html(kosakataAceh);
            $("#detail-kosakata-indonesia").html(kosakataIndonesia);
            $("#detail-deskripsi").html(deskripsi);

            if (gambar == '-') {
                $("#detail-gambar").html('-');
            } else {
                $("#detail-gambar").html('<img src="../assets/img/translate-images/' + gambar + '"alt="preview-image" style="width: 220px">');
            }

            if (audio == '-') {
                $("#detail-audio").html('-');
            } else {
                $("#detail-audio").html('<audio controls preload="metadata" style=" width:300px;"><source src="../assets/audio/translate-audio/'+ audio +'" type="audio/mpeg">Your browser does not support the audio element.</audio>');
            }
        }

        function editKosakata (id, oldAceh, oldIndonesia, oldDeskripsi) {
            $("#edit-kosakata-form").attr('action', '{{ route('admin.kamus.update') }}'+'/'+id);
            $("#edit-aceh").val(oldAceh);
            $("#edit-indonesia").val(oldIndonesia);

            if (oldDeskripsi != '-') {
                $("#edit-deskripsi").val(oldDeskripsi);
            }
        }

        function editDanTerimaSaran (aceh, indonesia, deskripsi) {
            $("#aceh").val(aceh);
            $("#indonesia").val(indonesia);

            if (deskripsi != '-') {
                $("#deskripsi").val(deskripsi);
            }

            $("#lihat-saran").modal('hide');
            $("#tambah-kosakata").modal('show');
        }

        function sediakanTerjemahan (kosakata, bahasaTujuan) {
            if (bahasaTujuan == 'aceh') {
                $("#aceh").val('');
                $("#indonesia").val(kosakata);
                $("#deskripsi").val('');
            } else if (bahasaTujuan == 'indonesia') {
                $("#aceh").val(kosakata);
                $("#indonesia").val('');
                $("#deskripsi").val('');
            }

            $("#lihat-request").modal('hide');
            $("#tambah-kosakata").modal('show');
        }
    </script>
@endsection
