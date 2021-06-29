<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Dictionary;
use App\Models\VocabularyRequest;
use App\Models\VocabularySuggestion;

class KamusController extends Controller
{
    public function index()
    {
        return view('admin.kamus', [
            'navItemActive' => 'kamus',
            'pageTitle' => 'Kamus',
            'dictionary' => Dictionary::orderBy('created_at', 'DESC')->get(),
            'vocabularyRequests' => VocabularyRequest::orderBy('created_at', 'DESC')->get(),
            'vocabularySuggestions' => VocabularySuggestion::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function addVocabulary (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aceh' => 'required',
            'indonesia' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => 'Harap masukkan :attribute',
            'gambar.image' => ':attribute tidak valid',
            'gambar.mimes' => ':attribute harus berformat jpg, jpeg atau png',
            'gambar.max' => ':attribute harus berukuran tidak lebih dari 2 MB'
        ], [
            'aceh' => 'Kosakata Bahasa Aceh',
            'indonesia' => 'Kosakata Bahasa Indonesia',
            'gambar' => 'Gambar'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kamus')
                        ->withErrors($validator, 'addVocabulary')
                        ->withInput();
        }

        $data = [
            'aceh' => $request->aceh,
            'indonesia' => $request->indonesia,
        ];

        // Menyimpan Deskripsi
        if (!empty($request->deskripsi)) {
            $data['deskripsi'] = $request->deskripsi;
        }

        //Menyimpan Gambar
        if ($request->hasFile('gambar')) {
            $ext = $request->gambar->extension();
            $imageName = str_replace(' ', '-', strtolower($request->indonesia)).'-'.Str::random(5).'.'.$ext;
            $request->gambar->storeAs('images/translate-images', $imageName);
            $data['gambar'] = $imageName;
        }

        Dictionary::create($data);

        //Menghapus saran dan request bila diperlukan
        VocabularySuggestion::where([['aceh', '=', $request->aceh], ['indonesia', '=', $request->indonesia]])->delete();
        VocabularyRequest::where('kosakata', $request->aceh)->delete();
        VocabularyRequest::where('kosakata', $request->indonesia)->delete();

        return redirect()->route('admin.kamus')->with('success', 'Kosakata berhasil ditambahkan');
    }

    public function acceptVocabulary ($id)
    {
        $vocabularySuggestion = VocabularySuggestion::where('id', $id);

        $data = [
            'aceh' => $vocabularySuggestion->first()->aceh,
            'indonesia' => $vocabularySuggestion->first()->indonesia
        ];

        if (isset($vocabularySuggestion->first()->deskripsi)) {
            $data['deskripsi'] = $vocabularySuggestion->first()->deskripsi;
        }

        Dictionary::create($data);
        $vocabularySuggestion->delete();

        return redirect()->route('admin.kamus')->with('success', 'Kosakata yang disarankan berhasil ditambahkan secara langsung');
    }

    public function denyVocabulary ($id)
    {
        $vocabularySuggestion = VocabularySuggestion::where('id', $id);
        $vocabularySuggestion->delete();

        return redirect()->route('admin.kamus')->with('success', 'Saran Kosakata ditolak');
    }

    public function denyRequest ($id)
    {
        $vocabularyRequest = VocabularyRequest::where('id', $id);
        $vocabularyRequest->delete();

        return redirect()->route('admin.kamus')->with('success', 'Request Kosakata diabaikan');
    }

    public function updateVocabulary ($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aceh' => 'required',
            'indonesia' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => 'Harap masukkan :attribute',
            'gambar.image' => ':attribute tidak valid',
            'gambar.mimes' => ':attribute harus berformat jpg, jpeg atau png',
            'gambar.max' => ':attribute harus berukuran tidak lebih dari 2 MB'
        ], [
            'aceh' => 'Kosakata Bahasa Aceh',
            'indonesia' => 'Kosakata Bahasa Indonesia',
            'gambar' => 'Gambar'
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
            Storage::delete('images/translate-images/' . $oldImageName);

            $ext = $request->gambar->extension();
            $imageName = str_replace(' ', '-', strtolower($request->indonesia)).'-'.Str::random(5).'.'.$ext;
            $request->gambar->storeAs('images/translate-images', $imageName);
            $data['gambar'] = $imageName;
        }

        Dictionary::where('id', $id)->update($data);

        return redirect()->route('admin.kamus')->with('success', 'Kosakata berhasil diupdate');
    }

    public function deleteVocabulary($dictionaryId)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        try {
            if ($dictionary->gambar != 'no-image.jpg') {
                Storage::delete('images/translate-images/'.$dictionary->gambar);
            }
            $dictionary->delete();
            return redirect()->route('admin.kamus')->with('success', 'Kosakata berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->route('admin.kamus')->with('error', 'Gagal menghapus kosakata');
        }
    }
}
