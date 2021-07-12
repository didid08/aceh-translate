<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dictionary;

class KamusController extends Controller
{
    public function index($word = null)
    {
        $data = [
            'title' => 'Kamus Bahasa Aceh',
            'headerTitle' => 'Kamus Bahasa Aceh',
            'headerLink' => route('home.kamus'),
            'dictionaries' => Dictionary::get()
        ];

        if ($word != null) {

            $data['word'] = html_entity_decode($word);

            $query = Dictionary::where('aceh', html_entity_decode($word));

            if ($query->exists()) {

                if ($query->get()->count() > 1) {

                    $translatedWord = [];
                    $description = [];
                    $imagePreview = [];
                    $audio = [];

                    foreach ($query->get() as $row) {
                        array_push($translatedWord, $row->indonesia);
                        if ($row->deskripsi != null) {
                            array_push($description, $row->deskripsi);
                        }
                        if ($row->gambar != null) {
                            array_push($imagePreview, $row->gambar);
                        }
                        if ($row->audio != null) {
                            array_push($audio, $row->audio);
                        }
                    }

                    if (sizeof($description) == 0) {
                        $description = null;
                    }
                    if (sizeof($imagePreview) == 0) {
                        $imagePreview = null;
                    }
                    if (sizeof($audio) == 0) {
                        $audio = null;
                    }

                    $data['translatedWord'] = $translatedWord;
                    $data['description'] = $description;
                    $data['imagePreview'] = $imagePreview;
                    $data['audio'] = $audio;

                } else {
                    $data['translatedWord'] = $query->first()->indonesia;
                    $data['description'] = $query->first()->deskripsi;
                    $data['imagePreview'] = $query->first()->gambar;
                    $data['audio'] = $query->first()->audio;
                }

            } else {
                return abort(404);
            }
        }

        return view('home.kamus', $data);
    }
}
