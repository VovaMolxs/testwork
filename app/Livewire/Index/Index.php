<?php

namespace App\Livewire\Index;

use Illuminate\Validation\Rules\File;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Laravel\Prompts\error;

class Index extends Component
{
    use WithFileUploads;

    public $firstname;
    public $surname;
    public $lastname;
    public $date_born;
    public $email;
    public $country_mark = [];
    public $phone_number = [];
    public $family_status;
    public $about;
    public $file = [];
    public $checkbox = false;

    public $inputPhone = [];
    public $inputCountryMark = [];
    public $counter = 0;

    protected $rules = [
        'firstname' => 'required|string|min:3|max:20',
        'surname' => 'required|string|min:3|max:20',
        'lastname' => 'string|min:3|max:20|nullable',
        'date_born' => 'required|date',
        'email' => 'email',
        'family_status' => 'required|numeric',
        'about' => 'string|max:1000|nullable',
        'file.*' => 'jpg|png|pdf|max:5100',
        'checkbox' => 'accepted',
    ];

    public function addPhone() {
        $this->inputPhone[] = null;
        $this->inputCountryMark[] = null;
        $this->counter += 1;

    }

    public function delPhone($index) {
        unset($this->inputPhone[$index]);
        dd($this->phone_number);
    }

    public function validateForm() {

        if (empty($this->email) && empty($this->phone_number[0])) {
            $this->rules['email'] =  'email|required';
        }

        if (!empty($this->email) && empty($this->phone_number[0])) {
            $this->rules['email'] = 'email';
        }

        //только телефон(ы), значит добавляем валидацию для телефонов
        if (empty($this->email) && !empty($this->phone_number[0])) {
            $this->rules['country_mark'] = ['required', 'array', 'min:1'];
            $this->rules['country_mark.*'] = ['required', 'regex:/\+[0-9]{1,3}/'];
            $this->rules['phone_number'] =  ['required', 'array'];
            $this->rules['phone_number.*'] = ['required', 'regex:/[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2}/'];
        }

        if (!empty($this->email) && !empty($this->phone_number[0])) {
            $this->rules['email'] = 'email';
            $this->rules['country_mark'] = ['required', 'array', 'min:1'];
            $this->rules['country_mark.*'] = ['required', 'regex:/\+[0-9]{1,3}/'];
            $this->rules['phone_number'] =  ['required', 'array'];
            $this->rules['phone_number.*'] = ['required', 'regex:/[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2}/'];
        }

        dd($this->rules);
        $validateData = $this->validate($this->rules);

    }

    public function store() {

    }


    public function render()
    {
        return view('livewire.index.index')->extends('layouts.app');
    }
}
