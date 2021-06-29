<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Dictionary;
use App\Models\VocabularyRequest;
use App\Models\VocabularySuggestion;

class TranslateController extends Controller
{
    public function index($word = null, $translateTo = null)
    {
        $data = ['title' => 'Kamus Bahasa Aceh | Translate', 'headerTitle' => 'Translate', 'headerLink' => route('home.translate')];

        if ($word != null && $translateTo != null) {
            if ($translateTo == 'aceh' || $translateTo == 'indonesia') {

                $data['word'] = html_entity_decode($word);

                if ($translateTo == 'aceh') {
                    $data['translateFrom'] = 'indonesia';
                    $data['translateTo'] = 'aceh';
                } else if ($translateTo == 'indonesia') {
                    $data['translateFrom'] = 'aceh';
                    $data['translateTo'] = 'indonesia';
                }

                $translateFrom = $data['translateFrom'];
                $translateTo = $data['translateTo'];

                $query = Dictionary::where($translateFrom, html_entity_decode($word));

                if ($query->exists()) {

                    if ($query->get()->count() > 1) {

                        $translatedWord = [];
                        $description = [];
                        $imagePreview = [];

                        foreach ($query->get() as $row) {
                            array_push($translatedWord, $row->$translateTo);
                            if ($row->deskripsi != null) {
                                array_push($description, $row->deskripsi);
                            }
                            if ($row->gambar != null) {
                                array_push($imagePreview, $row->gambar);
                            }
                        }

                        if (sizeof($description) == 0) {
                            $description = null;
                        }
                        if (sizeof($imagePreview) == 0) {
                            $imagePreview = null;
                        }

                        $data['translatedWord'] = $translatedWord;
                        $data['description'] = $description;
                        $data['imagePreview'] = $imagePreview;

                    } else {
                        $data['translatedWord'] = $query->first()->$translateTo;
                        $data['description'] = $query->first()->deskripsi;
                        $data['imagePreview'] = $query->first()->gambar;
                    }

                } else {
                    $data['translatedWord'] = null;
                    $data['description'] = null;
                    $data['imagePreview'] = null;
                }

            } else {
                return abort(404);
            }
        }

        return view('home.translate', $data);
    }

    public function pushSuggestion (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aceh' => 'required',
            'indonesia' => 'required'
        ], [
            'required' => 'Harap masukkan :attribute'
        ], [
            'aceh' => 'Kosakata Bahasa Aceh',
            'indonesia' => 'Kosakata Bahasa Indonesia'
        ]);

        if ($validator->fails()) {
            return redirect()->route('home.translate')
                        ->withErrors($validator, 'vocabularySuggestion')
                        ->withInput();
        }

        $data = [
            'aceh' => $request->aceh,
            'indonesia' => $request->indonesia,
        ];

        // Menambah Deskripsi
        if (!empty($request->deskripsi)) {
            $data['deskripsi'] = $request->deskripsi;
        }

        VocabularySuggestion::create($data);

        return redirect()->route('home.translate')->with('success', 'Berhasil menyarankan terjemahan');
    }

    public function pushRequest (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kosakata' => 'required',
            'bahasa_tujuan' => 'required'
        ], [
            'required' => 'Harap masukkan :attribute'
        ], [
            'kosakata' => 'Kosakata',
            'bahasa_tujuan' => 'Bahasa Tujuan'
        ]);

        if ($validator->fails()) {
            return redirect()->route('home.translate')
                        ->withErrors($validator, 'vocabularyRequest')
                        ->withInput();
        }

        VocabularyRequest::create([
            'kosakata' => $request->kosakata,
            'bahasa_tujuan' => $request->bahasa_tujuan
        ]);

        return redirect()->route('home.translate')->with('success', 'Berhasil request terjemahan');
    }
}
