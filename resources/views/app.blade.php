<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aceh Translate</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css" rel="stylesheet" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row p-3 bg-primary text-white">
            <div class="col-9 mt-1">
                <h4>AcehTranslate</h4>
            </div>
            <div class="col-3">
                <div class="btn-group shadow-0" style="float: right">
                    <button type="button" class="btn btn-light dropdown-toggle" data-mdb-toggle="dropdown"
                        aria-expanded="false">
                        More
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-mdb-toggle="modal" data-mdb-target="#saran-terjemahan">Saran Terjemahan</a></li>
                        <li><a class="dropdown-item" href="#" data-mdb-toggle="modal" data-mdb-target="#request-terjemahan">Request Terjemahan</a></li>
                    </ul>
                </div>

                {{-- REQUEST TERJEMAHAN --}}
                <div class="modal fade" id="request-terjemahan" style="display: none" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-black">Request Terjemahan</h5>
                                <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="/" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="kosakata" name="kosakata"
                                            placeholder="Masukkan kosakata yang ingin disediakan terjemahannya" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Bahasa Tujuan</span>
                                        </div>
                                        <select class="form-control" name="bahasa_tujuan" id="bahasa_tujuan">
                                            <option value="aceh" selected>Aceh</option>
                                            <option value="indonesia">Indonesia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default"
                                        data-mdb-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- SARAN TERJEMAHAN --}}
                <div class="modal fade" id="saran-terjemahan" style="display: none" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-black">Saran Terjemahan</h5>
                                <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="/" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Aceh</span>
                                        </div>
                                        <input type="text" class="form-control" id="aceh" name="aceh"
                                            placeholder="Masukkan kosakata" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Indonesia</span>
                                        </div>
                                        <input type="text" class="form-control" id="indonesia" name="indonesia"
                                            placeholder="Masukkan kosakata" required>
                                    </div>

                                    <div class="form-outline mb-3">
                                        <textarea rows="3" class="form-control p-2" id="deskripsi"
                                            name="deskripsi"></textarea>
                                        <label class="form-label" for="deskripsi">Deskripsi (Opsional)</label>
                                    </div>

                                    <div class="text-left text-black font-weight-light" style="font-size: 0.8em">
                                        <i>Catatan: Terjemahan yang anda sarankan akan melalui proses pengecekan terlebih
                                            dahulu sebelum ditambahkan ke database</i></div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default"
                                        data-mdb-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row p-3">
            <div class="col-sm-12 col-lg-6">
                <div class="row">
                    <div class="col-12 p-2">
                        <select id="translateFrom" class="form-control">
                            <option value="indonesia"
                                {{ isset($translateFrom) ? ($translateFrom == 'indonesia' ? ' selected' : '') : '' }}>
                                Indonesia</option>
                            <option value="aceh"
                                {{ isset($translateFrom) ? ($translateFrom == 'aceh' ? ' selected' : '') : '' }}>Aceh
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="md-form">
                            <textarea class="md-textarea form-control" id="toTranslate" rows="10"
                                placeholder="Masukkan kata yang ingin diterjemahkan lalu tekan enter">{{ $word ?? '' }}</textarea>
                            <!--<label for="toTranslate">Yang mau diterjemahkan</label>-->
                        </div>
                        <!--<br><button id="translate" class="btn btn-primary">Terjemahkan</button>-->
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-11">
                        <i class="fa fa-history"></i>&nbsp;&nbsp;History
                    </div>
                    <div class="col-1">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-12 p-2 border">
                        -----
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="row">
                    <div class="col-12 p-2">
                        <select id="translateTo" class="form-control">
                            <option value="aceh"
                                {{ isset($translateTo) ? ($translateTo == 'aceh' ? ' selected' : '') : '' }}>Aceh
                            </option>
                            <option value="indonesia"
                                {{ isset($translateTo) ? ($translateTo == 'indonesia' ? ' selected' : '') : '' }}>Indonesia
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="md-form">
                            <textarea class="md-textarea form-control" id="translateResult" rows="10"
                                placeholder="Hasil" readonly>{{ $translatedWord ?? '' }}</textarea>
                            <!--<label for="translateResult">Hasil</label>-->
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12">
                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;Preview & Description
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-12 p-2 border">
                        @if (isset($imagePreview))
                            <img src="{{ asset('assets/img/translate-images/' . $imagePreview) }}" alt=""
                                style="width: 220px; height: 200px; float: left; margin-right: 0.5em;">
                        @else
                            -
                        @endif
                        @if (isset($description))
                            {!! $description !!}
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            @if (session()->has('success'))
                toastr.success('{{ session()->get('success') }}')
            @endif
            @if (session()->has('error'))
                toastr.error('{{ session()->get('error') }}')
            @endif
        });

        $('#translateFrom').on('change', function() {
            if ($('#translateFrom').val() == 'aceh') {
                $('#translateTo').val('indonesia');
            } else if ($('#translateFrom').val() == 'indonesia') {
                $('#translateTo').val('aceh');
            }
        });

        $('#translateTo').on('change', function() {
            if ($('#translateTo').val() == 'aceh') {
                $('#translateFrom').val('indonesia');
            } else if ($('#translateTo').val() == 'indonesia') {
                $('#translateFrom').val('aceh');
            }
        });

        $('#toTranslate').on('keypress', function(e) {
            if (e.which == 13) {
                if ($('#toTranslate').val() == '') {
                    alert('Harap masukkan kata');
                    $('#toTranslate').val('');
                } else {
                    window.location.replace(window.location.origin + '/home/translate/' + $('#toTranslate').val() +
                        '/' + $('#translateTo').val());
                }
            }
        });
    </script>
</body>

</html>
