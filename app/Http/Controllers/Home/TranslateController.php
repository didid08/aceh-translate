<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dictionary;

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
                            array_push($description, $row->deskripsi);
                            array_push($imagePreview, $row->gambar);
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
                    $data['translatedWord'] = 'unknown';
                    $data['description'] = '-';
                    $data['imagePreview'] = 'no-image.jpg';
                }

            } else {
                return abort(404);
            }
        }

        return view('home.translate', $data);
    }
}
