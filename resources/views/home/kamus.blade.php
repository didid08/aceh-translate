@extends('home.master')

@section('header-menu-list')
    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="cursor: pointer;" href="{{ route('home.translate') }}">Translate</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td style="font-size: 1.3em; font-weight: bold;">Sawah</td>
                        </tr>
                        <tr>
                            <td>
                                @php
                                    // Untuk menghindari kata yang duplikat, jadi saya buat variable jejak. Kemudian nanti dicek didalam foreach apakah hasil yg diiterasi sudah pernah ditampilkan sebelumnya.
                                    $lastWord = null;
                                @endphp
                                <table class="table table-bordered table-striped" id="daftar-kosakata">
                                    <thead>
                                        <tr>
                                            <th>Kosakata</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dictionaries->sortBy('aceh') as $dictionary)
                                            @if ($lastWord != $dictionary->aceh)
                                                <tr>
                                                    <td style="width: 70%">
                                                        {{ ucfirst($dictionary->aceh) }}
                                                    </td>
                                                    <td class="text-center align-middle pt-3">
                                                        <a href="{{ route('home.kamus', ['word' => $dictionary->aceh]) }}" class="text-center btn {{ isset($word) ? ($word == $dictionary->aceh ? 'btn-secondary' : 'btn-outline-secondary') : 'btn-outline-secondary' }} mr-2 mb-2">Lihat Detail</a>
                                                    </td>
                                                </tr>
                                            @endif
                                            @php
                                                $lastWord = $dictionary->aceh;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if (isset($word))
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td colspan="2" style="font-size: 1.3em; font-weight: bold;">Detail</td>
                            </tr>
                            <tr>
                                <td style="width: 38%">Kosakata (Aceh)</td>
                                <td>{{ ucfirst($word) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 38%">Kosakata (Indonesia)</td>
                                <td>
                                    @if (is_array($translatedWord))
                                        {{ ucfirst(join(', ', $translatedWord)) }}
                                    @else
                                        {{ ucfirst($translatedWord) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 38%">Deskripsi</td>
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
                                <td style="width: 38%">Gambar</td>
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
                                <td style="width: 38%">Audio</td>
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
                            <i>Klik kosakata untuk menampilkan detail</i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready( function () {
            $('#daftar-kosakata').DataTable();
        } );
    </script>
@endsection
