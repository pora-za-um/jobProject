<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Photo;
use App\Model\User;
use App\Model\Autorisation;

class Profile
    extends Controller
{

    public function actionPage()
    {

        $this->chekRegistration();

    }

    public function chekRegistration()
    {

        if (!empty($_SESSION['login']) && !empty($_SESSION['password'])) {
            //если существует логин и пароль в сессиях, то проверяем, действительны ли они
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];

            if (User::findByLoginAndPass($login, $password) == false) {

                throw new \Exception("Вход на эту страницу разрешен только зарегистрированным пользователям! <br><a href='/../../'>Главная страница</a>");
            } else {

                $user = User::findByUserId($_GET['id']);
                $this->view->user = $user;
                $this->view->display(__DIR__ . '/../../Views/page.php');

                $this->view->display(__DIR__ . '/../../Views/form_file_upload.html');

                $i = new Index();
                $i->actionShowUsers();

            }

        }

    }

    public function actionEditInformation()
    {

        if (!empty($_POST)) {

            $data = [];

            $a = new Autorisation();

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
                $data['password'] = $a->clean($data['password']);
            }
            if (!empty($_POST['email'])) {
                $data['email'] = $_POST['email'];
                $data['email'] = $a->clean($data['email']);
                //$email_validate = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
            }
            if (!empty($_POST['information'])) {
                $data['information'] = $_POST['information'];
            }

            $data['user_id'] = $_SESSION['id'];


            if (isset($data['password']) || isset($data['email']) || isset($data['information'])) {

                if ($a->check_length($data['password'], 4, 15))
                    $_SESSION['password'] = $data['password'];

                User::profileInformationEdit($data);

                echo "Профиль отредактирован.<br><a href='/../'>На главную страницу</a>";
            } else
                echo "Введенные данные некорректные <br><a href='/../'>На главную страницу</a>";


        }
    }


}

