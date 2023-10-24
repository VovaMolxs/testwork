<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstname",
        "surname",
        "lastname",
        "date_born",
        "email",
        "family_status",
        "about",
        "files",
        "user_phone",
    ];
}
