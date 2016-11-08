<?php

namespace App\Model;

use App\Model;

class User
    extends Model
{

    public static $table = 'users';

    public $user_id;
    public $login;
    public $password;
    public $email;
    public $information;
    public $img_count;
}