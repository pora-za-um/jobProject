<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Photo;
use App\Model\User;
use App\Model\Autorisation;

class File
    extends Controller
{

    public function actionUpload()
    {

        if (!empty($_POST)) {

            $data = [];

            if (!empty($_POST['title'])) {
                $data['title'] = $_POST['title'];
            }
            if (!empty($_POST['description'])) {
                $data['textimg'] = $_POST['description'];
            }
            if (!empty($_POST['date'])) {
                $data['date'] = $_POST['date'];
            }

            $data['user_id'] = $_SESSION['id'];


            if (!empty($_FILES)) {
                $res = $this->actionFileMove('image');
                if (false !== $res) {
                    $data['path'] = $res;
                }
            }

            if (isset($data['title']) && isset($data['textimg']) && isset($data['date']) && isset($data['path'])) {


                User::increaseImgCount($_SESSION['id']);

                Autorisation::photoInsert($data);

                echo "Файл успешно загружен.<br><a href='/../'>На главную страницу</a>";

            } else {
                echo "Что-то пошло не так.  <br><a href='/../'>На главную страницу</a>";

            }

        }


    }

    public function actionFileMove($field)
    {
        if (empty($_FILES))
            return false;
        if (0 != $_FILES[$field]['error'])
            return false;
        if ('image/jpeg' !== $_FILES[$field]['type'])
            return false;
        if (is_uploaded_file($_FILES[$field]['tmp_name'])) {
            $res = move_uploaded_file($_FILES[$field]['tmp_name'], __DIR__ . '/../../img/' . $_FILES[$field]['name']);
            if (!$res) {
                return false;
            } else {
                return '/img/' . $_FILES[$field]['name'];
            }
        }
        return false;
    }

    public function actionEdit()
    {

        if (!empty($_POST)) {

            $data = [];

            if (!empty($_POST['title'])) {
                $data['title'] = $_POST['title'];
            }
            if (!empty($_POST['textimg'])) {
                $data['textimg'] = $_POST['textimg'];
            }

            $data['id'] = $_SESSION['id_photo'];

            if (isset($data['title']) && isset($data['textimg'])) {

                Photo::photoEdit($data);

                echo "Файл успешно отредактирован.<br><a href='/../'>На главную страницу</a>";

            } else {
                echo "Что-то пошло не так.  <br><a href='/../'>На главную страницу</a>";

            }

        }


    }


}
