@extends('home.master')

@section('header-menu-list')
    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('home.kamus') }}" style="cursor: pointer">Kamus</a></li>
    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" data-bs-toggle="modal" data-bs-target="#sarankan-terjemahan" style="cursor: pointer">Sarankan Terjemahan</a></li>
    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" data-bs-toggle="modal" data-bs-target="#request-terjemahan" style="cursor: pointer">Request Terjemahan</a></li>
@endsection
@section('content')

    {{-- SARAN TERJEMAHAN --}}
    <div class="modal fade" id="sarankan-terjemahan" style="display: none" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black">Sarankan Terjemahan</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('home.translate.sarankan') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="input-group mb-3">
                            <textarea rows="3" class="form-control p-2" id="deskripsi"
                                name="deskripsi" placeholder="Deskripsi (opsional)"></textarea>
                        </div>

                        <div class="text-left text-black font-weight-light" style="font-size: 0.8em">
                            <i>Catatan: Terjemahan yang anda sarankan akan melalui proses pengecekan terlebih
                                dahulu sebelum ditambahkan ke database</i></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REQUEST TERJEMAHAN --}}
    <div class="modal fade" id="request-terjemahan" style="display: none" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black">Request Terjemahan</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('home.translate.request') }}" method="POST" enctype="multipart/form-data">
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
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="row mb-2">
                <select id="translateFrom" class="form-control">
                    <option value="indonesia"
                        {{ isset($translateFrom) ? ($translateFrom == 'indonesia' ? ' selected' : '') : '' }}>
                        Indonesia</option>
                    <option value="aceh"
                        {{ isset($translateFrom) ? ($translateFrom == 'aceh' ? ' selected' : '') : '' }}>Aceh
                    </option>
                </select>
            </div>
            <div class="row">
                <textarea class="form-control" id="toTranslate" rows="3" placeholder="Masukkan kata yang ingin diterjemahkan lalu tekan enter">{{ $word ?? '' }}</textarea>
            </div>
            <div class="row mt-4 mb-4">
                <div class="text-center text-white">
                    -- TO --
                </div>
            </div>
            <div class="row mb-2">
                <select id="translateTo" class="form-control">
                    <option value="aceh"
                        {{ isset($translateTo) ? ($translateTo == 'aceh' ? ' selected' : '') : '' }}>Aceh
                    </option>
                    <option value="indonesia"
                        {{ isset($translateTo) ? ($translateTo == 'indonesia' ? ' selected' : '') : '' }}>Indonesia
                    </option>
                </select>
            </div>
            <div class="row mb-3">
                <textarea class="form-control" id="translateResult" rows="3" placeholder="{{ isset($word) ? 'Terjemahan tidak ditemukan' : 'Terjemahan akan muncul disini' }}" readonly>
                    @if (isset($translatedWord))
                        @if (is_array($translatedWord))
                            {{ ucfirst(join(', ', $translatedWord)) }}
                        @else
                            {{ ucfirst($translatedWord) }}
                        @endif
                    @endif
                </textarea>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if (isset($translatedWord))
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td style="width: 25%">Deskripsi</td>
                                <td>
                                    @if (isset($description))
                                        @if (is_array($description))
                                            {!! $description[0] !!}
                                        @else
                                            {!! $description !!}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">Gambar</td>
                                <td>
                                    @if (isset($imagePreview))
                                        @if (is_array($imagePreview))
                                            @foreach ($imagePreview as $img)
                                                <img src="{{ asset('assets/img/translate-images/' . $img) }}" alt="Preview" style="width: 220px; margin: 0 0.5em 0.5em 0;">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('assets/img/translate-images/' . $imagePreview) }}" alt="Preview" style="width: 220px; margin: 0 0.5em 0.5em 0;">
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">Audio</td>
                                <td>
                                    <audio controls preload="metadata" style=" width:300px;">
                                        <source src="{{ asset('assets/audio/adee padee.mp3') }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio><br />
                                </td>
                            </tr>
                        </table>
                    @else
                        <div class="text-center" style="padding: 9.4em 0;">
                            <i>Detail terjemahan akan muncul disini</i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
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

        $("#translateResult").val($("#translateResult").val().trim());

        @if (!isset($translatedWord) && isset($word))
            $(document).ready(function () {
                swal({
                    title: "Terjemahan tidak ditemukan",
                    text: "Harap coba lagi!",
                    icon: "error",
                    button: "OK"
                });
            });
        @endif
    </script>
@endsection
