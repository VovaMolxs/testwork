<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class IndexController extends Controller
{
    public function index() {
        return view('index');
    }

    public function store(Request $request) {


        $rulesValidate = [
            "firstname" => "required|string|min:3|max:20",
            "surname" => "required|string|min:3|max:20",
            "lastname" => "nullable|string|max:20",
            "date_born" => "required|date",
            "family_status" => "numeric",
            "about" => "string|max:1000|nullable",
            "checkbox" => "accepted",
        ];

            if (empty($request['file_'])) {
                $rulesValidate['file_'] = 'required';
            } else if ((count($request['file_']) < 6)) {
                $rulesValidate['file_.*'] = ['required',
                    File::types(['jpg', 'png', 'pdf'])
                        ->max(5 * 1024),
                ];
            } else {
                $rulesValidate['file_'] = 'string';
            }


        //пришел пустой email и телефон
        if (empty($request['email']) && empty($request['phone_number_1'])) {
            $rulesValidate['email'] = "required|email";
        }

        //только email, значит добавляем его в валидацию
        if (!empty($request['email']) && empty($request['phone_number_1'])) {
            $rulesValidate['email'] = "email";
        }

        //только телефон(ы), значит добавляем валидацию для телефонов
        if (empty($request['email']) && !empty($request['phone_number_1'])) {
            for ($i = 0; $i < $request['count_phone_number']; $i++) {
                $rulesValidate['country_mark_' . $i+1] = 'required';
                $rulesValidate['phone_number_' . $i+1] = 'regex:/[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2}/';
            }
        }

        //если и телефон и email тогда все поля добавляем
        if (!empty($request['email']) && !empty($request['phone_number_1'])) {
            $rulesValidate['email'] = 'email';
            for ($i = 0; $i < $request['count_phone_number']; $i++) {
                $rulesValidate['country_mark_' . $i+1] = 'required';
                $rulesValidate['phone_number_' . $i+1] = 'regex:/[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2}/';
            }
        }

        $data = $request->validate($rulesValidate);

        //work with files
        $files = [];

        foreach ($data['file_'] as $file) {
            $files[] = Storage::putFile('public/file', $file);
        }
        unset($data['file_']);
        $data['files'] = implode('|', $files);

        //user phone
        $phones = [];
        for ($i = 1; $i <= $request['count_phone_number']; $i++) {
            $phones[] = $request['country_mark_' . $i] . "-" . $request['phone_number_' . $i];
            unset($data['country_mark_' . $i], $data['phone_number_' . $i]);
        }
        $data['user_phone'] = implode('|', $phones);

        Employees::create($data);
        echo json_encode($data);

    }
}
