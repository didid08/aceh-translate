<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictionary;

class HomeController extends Controller
{
    public function index($action = null, $word = null, $translateTo = null)
    {
        if ($action != 'translate' && $action != null) {
            return abort(404);
        }

        $data = [];
        /*
            $data = [
                'translateFrom' => '',
                'translateTo' => '',
                'word' => '',
                'translatedWord' => ''
            ];
        */

        if ($word != null && $translateTo != null) {
            if ($translateTo == 'aceh' || $translateTo == 'indonesia') {

                $data['word'] = html_entity_decode($word);

                if ($translateTo == 'aceh') {

                    $data['translateFrom'] = 'indonesia';
                    $data['translateTo'] = 'aceh';

                    $query = Dictionary::where('indonesia', html_entity_decode($word));

                    if ($query->exists()) {
                        $data['translatedWord'] = ucfirst($query->first()->aceh);
                        $data['description'] = $query->first()->deskripsi;
                        $data['imagePreview'] = $query->first()->gambar;
                    } else {
                        $data['translatedWord'] = 'unknown';
                        $data['description'] = '-';
                        $data['imagePreview'] = 'no-image.jpg';
                    }

                } else if ($translateTo == 'indonesia') {

                    $data['translateFrom'] = 'aceh';
                    $data['translateTo'] = 'indonesia';


                    $query = Dictionary::where('aceh', html_entity_decode($word));

                    if ($query->exists()) {
                        $data['translatedWord'] = ucfirst($query->first()->indonesia);
                        $data['description'] = $query->first()->deskripsi;
                        $data['imagePreview'] = $query->first()->gambar;
                    } else {
                        $data['translatedWord'] = 'unknown';
                        $data['description'] = '-';
                        $data['imagePreview'] = 'no-image.jpg';
                    }
                }
            } else {
                return abort(404);
            }
        }

        return view('app', $data);
    }
}
