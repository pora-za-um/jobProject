<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Photo;
use App\Model\User;

class Photos
    extends Controller
{

    public function actionEdit()
    {
        //необходимо сделать проверку на подлинность юзера, чтобы не редактировал чужие фотографии
        $photo = Photo::findByColumn('id', $_GET['id']);


        if (empty($photo)) {
            throw new \Exception('Фото не найдено');
        }


        $this->view->photo = $photo;

        $this->view->display(__DIR__ . '/../../views/edit.php');


    }

    public function actionDelete()
    {
        //сделать проверку на подлинность юзера, чтобы не удалял чужие фотографии
        $item = Photo::findByColumn('id', $_GET['id']);
        if (empty($item)) {
            throw new \Exception('Фото не найдено');
        }

        Photo::delete($_GET['id']);
        //необходимо доработать запрос, чтобы не уменьшать счетчик, когда удаляется чужая фотография
        User::decreaseImgCount($_SESSION['id']);


        echo "Фотография успешно удалена.<br><a href='/../../'>Главная страница</a>";

    }

    public function actionOne()
    {
        $photo = Photo::findByUserId($_GET['id']);
        if (empty($photo)) {
            throw new \Exception('Фото не найдено');
        }
        $this->view->photo = $photo;
        $this->view->display(__DIR__ . '/../../views/photos/one.php');

    }

    public function actionUser()
    {
        $user = Photo::findByUserId($_GET['id']);
        if (empty($user)) {
            throw new \Exception('Пользователь не найден');
        }
        $this->view->user = $user;
        $this->view->display(__DIR__ . '/../../views/user.php');

        $users = User::findUsers();
        $this->view->users = $users;
        $this->view->display(__DIR__ . '/../../views/users_show.php');
    }

}

