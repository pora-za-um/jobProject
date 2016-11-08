<?php

namespace App\Controllers;


use App\Controller;
use App\Model\Photo;
use App\Model\User;
use App\Model\Autorisation;


class Index
    extends Controller
{

    public function actionDefault()
    {
        if (($_SESSION['login'] == 'admin')) {
            $_SESSION['id'] = '1';
        }

        $this->view->display(__DIR__ . '/../../Views/form_login.php');

        $photos = Photo::findLast5();
        $this->view->images = $photos;
        $this->view->display(__DIR__ . '/../../Views/index.php');

        $this->actionShowUsers();
    }

    public function actionShowUsers()
    {
        $users = User::findUsers();
        $this->view->users = $users;
        $this->view->display(__DIR__ . '/../../Views/users_show.php');
    }

    public function actionProfile()
    {
        $this->view->display(__DIR__ . '/../../Views/page.php');
    }

    public function actionLogin()
    {
        $aut = new Autorisation();
        $aut->actionChekLogin();
    }

    public function actionRegistration()
    {
        $aut = new Autorisation();

        $aut->actionSaveUser();

        if (empty($_POST['login']) || empty($_POST['password'])) {
            throw new \Exception('Пустой логин или пароль');
        }

    }


}