<?php

namespace App\Model;

use App\Model;

class Photo
    extends Model
{

    public static $table = 'images';

    public $id;
    public $title;
    public $textimg;
    public $path;
    public $date;
    public $user_id;

}

