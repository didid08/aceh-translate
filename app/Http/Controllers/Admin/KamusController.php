<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Manggil file Controller.php (File ini merupakan file wajib)
use Illuminate\Support\Facades\Validator; // Memanggil package untuk mengelola validasi form
use Illuminate\Database\QueryException; // Memanggil package untuk mengelola exception
use Illuminate\Support\Facades\Storage; // Memanggil package untuk mengelola file (read, write, edit, delete)
use Illuminate\Support\Str; // Memanggil package untuk memodify string yang bersangkutan
use Illuminate\Http\Request; // Memanggil package untuk mengelola request url

use App\Models\Dictionary; // Memanggil model Dictionary
use App\Models\VocabularyRequest; //Memanggil model Vocabulary Request
use App\Models\VocabularySuggestion; // Memanggil model Vocabulary Suggestion

class KamusController extends Controller
{
    /* Fungsi buat menampilkan halaman index dari admin/kamus */
    public function index()
    {
        // Meng-return view admin/kamus.blade.php
        return view('admin.kamus', [ // Yang dalam kurung [] ini merupakan data yang akan dikirim ke view
            'navItemActive' => 'kamus',
            'pageTitle' => 'Kamus',
            'dictionary' => Dictionary::orderBy('created_at', 'DESC')->get(),
            'vocabularyRequests' => VocabularyRequest::orderBy('created_at', 'DESC')->get(),
            'vocabularySuggestions' => VocabularySuggestion::orderBy('created_at', 'DESC')->get()
        ]);
    }

    /* Fungsi untuk memproses form tambah kosakata */
    public function addVocabulary (Request $request)
    {
        /* Skema buat validasi formnya */
        $validator = Validator::make($request->all(), [ // Rule buat form nya
            'aceh' => 'required',
            'indonesia' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048',
            'audio' => 'file|mimes:mp3,m4a,ogg,aac|max:10240'
        ], [ // Pesan yang ditampilkan jika melanggar rule yang bersangkutan
            'required' => 'Harap masukkan :attribute',
            'gambar.image' => ':attribute tidak valid',
            'gambar.mimes' => ':attribute harus berformat jpg, jpeg atau png',
            'gambar.max' => ':attribute harus berukuran tidak lebih dari 2 MB'
        ], [ // Memberi nama untuk input yg bersangkutan
            'aceh' => 'Kosakata Bahasa Aceh',
            'indonesia' => 'Kosakata Bahasa Indonesia',
            'gambar' => 'Gambar',
            'audio' => 'Audio'
        ]);

        // Abis tu, proses validasinya berjalan (jika gagal, kembali ke halaman awal. jika berhasil maka proses berikutnya akan dijalankan)
        if ($validator->fails()) {
            return redirect()->route('admin.kamus')
                        ->withErrors($validator, 'addVocabulary')
                        ->withInput();
        }

        // Data awal buat dikirim ke tabel "dictionary"
        $data = [
            'aceh' => $request->aceh,
            'indonesia' => $request->indonesia,
        ];

        // Menyimpan Deskripsi (Jika ada)
        if (!empty($request->deskripsi)) {
            $data['deskripsi'] = $request->deskripsi;
        }

        //Menyimpan Gambar (Jika ada)
        if ($request->hasFile('gambar')) {
            $ext = $request->gambar->extension();
            $imageName = str_replace(' ', '-', strtolower($request->indonesia)).'-'.Str::random(5).'.'.$ext;
            $request->gambar->storeAs('img/translate-images', $imageName, 'public_uploads');
            $data['gambar'] = $imageName;
        }

        //Menyimpan Audio (Jika ada)
        if ($request->hasFile('audio')) {
            $ext = $request->audio->extension();
            $audioName = str_replace(' ', '-', strtolower($request->indonesia)).'-'.Str::random(5).'.'.$ext;
            $request->audio->storeAs('audio/translate-audio', $audioName, 'public_uploads');
            $data['audio'] = $audioName;
        }

        Dictionary::create($data); // Insert Datanya ke table "dictionary"

        // Menghapus saran dan request jika kosakata yang dimasukkan ke "dictionary" berasal dari saran atau request
        VocabularySuggestion::where([['aceh', '=', $request->aceh], ['indonesia', '=', $request->indonesia]])->delete();
        VocabularyRequest::where('kosakata', $request->aceh)->delete();
        VocabularyRequest::where('kosakata', $request->indonesia)->delete();

        // Akhirnya prosesnya selesai

        // Kembali ke halaman awal boss, wiiii....
        return redirect()->route('admin.kamus')->with('success', 'Kosakata berhasil ditambahkan');
    }

    /* Fungsi untuk menerima saran terjemahan */
    public function acceptVocabulary ($id)
    {
        // Mengambil saran vocabulary sesuai id yang telah ditentukan
        $vocabularySuggestion = VocabularySuggestion::where('id', $id);

        // Data yang akan dimasukkan ke tabel dictionary
        $data = [
            'aceh' => $vocabularySuggestion->first()->aceh,
            'indonesia' => $vocabularySuggestion->first()->indonesia
        ];

        // Deskripsi juga ikutan dimasukkan (jika ada)
        if (isset($vocabularySuggestion->first()->deskripsi)) {
            $data['deskripsi'] = $vocabularySuggestion->first()->deskripsi;
        }

        // Terjemahannnya ditambahkan ke table dictionary
        Dictionary::create($data);

        //Hapus saran
        $vocabularySuggestion->delete();

        // Kembali ke halaman awal, wiiii....
        return redirect()->route('admin.kamus')->with('success', 'Kosakata yang disarankan berhasil ditambahkan secara langsung');
    }

    /* Fungsi untuk menolak saran terjemahan */
    public function denyVocabulary ($id)
    {
        $vocabularySuggestion = VocabularySuggestion::where('id', $id);
        $vocabularySuggestion->delete();

        return redirect()->route('admin.kamus')->with('success', 'Saran Kosakata ditolak');
    }

    /* Fungsi untuk menolak request terjemahan */
    public function denyRequest ($id)
    {
        $vocabularyRequest = VocabularyRequest::where('id', $id);
        $vocabularyRequest->delete();

        return redirect()->route('admin.kamus')->with('success', 'Request Kosakata diabaikan');
    }

    /* Fungsi untuk mengupdate terjemahan (Cara kerjanya hampir sama seperti function addVocabulary) */
    public function updateVocabulary ($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aceh' => 'required',
            'indonesia' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048',
            'audio' => 'file|mimes:mp3,m4a,ogg,aac|max:10240'
        ], [
            'required' => 'Harap masukkan :attribute',
            'gambar.image' => ':attribute tidak valid',
            'gambar.mimes' => ':attribute harus berformat jpg, jpeg atau png',
            'gambar.max' => ':attribute harus berukuran tidak lebih dari 2 MB'
        ], [
            'aceh' => 'Kosakata Bahasa Aceh',
            'indonesia' => 'Kosakata Bahasa Indonesia',
            'gambar' => 'Gambar',
            'audio' => 'Audio'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kamus')
                        ->withErrors($validator, 'updateVocabulary')
                        ->withInput();
        }

        $data = [
            'aceh' => $request->aceh,
            'indonesia' => $request->indonesia,
        ];

        // Mengupdate Deskripsi
        if (!empty($request->deskripsi)) {
            $data['deskripsi'] = $request->deskripsi;
        }

        // Mengupdate Gambar
        if ($request->hasFile('gambar')) {

            // Hapus Gambar Lama
            $oldImageName = Dictionary::firstWhere('id', $id)->gambar;
            Storage::disk('public_uploads')->delete('img/translate-images/' . $oldImageName);

            $ext = $request->gambar->extension();
            $imageName = str_replace(' ', '-', strtolower($request->indonesia)).'-'.Str::random(5).'.'.$ext;
            $request->gambar->storeAs('img/translate-images', $imageName, 'public_uploads');
            $data['gambar'] = $imageName;
        }

        //Mengupdate Audio
        if ($request->hasFile('audio')) {
            // Hapus Audio Lama
            $oldAudioName = Dictionary::firstWhere('id', $id)->audio;
            Storage::disk('public_uploads')->delete('audio/translate-audio/' . $oldAudioName);

            $ext = $request->audio->extension();
            $audioName = str_replace(' ', '-', strtolower($request->indonesia)).'-'.Str::random(5).'.'.$ext;
            $request->audio->storeAs('audio/translate-audio', $audioName, 'public_uploads');
            $data['audio'] = $audioName;
        }

        Dictionary::where('id', $id)->update($data);

        return redirect()->route('admin.kamus')->with('success', 'Kosakata berhasil diupdate');
    }

    /* Fungsi untuk menghapus terjemahan */
    public function deleteVocabulary($dictionaryId)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        try {
            if (isset($dictionary->gambar)) {
                Storage::disk('public_uploads')->delete('img/translate-images/'.$dictionary->gambar);
            }
            if (isset($dictionary->audio)) {
                Storage::disk('public_uploads')->delete('audio/translate-audio/'.$dictionary->audio);
            }
            $dictionary->delete();
            return redirect()->route('admin.kamus')->with('success', 'Kosakata berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->route('admin.kamus')->with('error', 'Gagal menghapus kosakata');
        }
    }
}
