<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Photo;
use App\Model\User;

class Users
    extends Controller
{

    public function actionUser()
    {
        $article = Photo::findByUserId($_GET['id']);
        if (empty($article)) {
            throw new \Exception('');
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../views/user.php');
    }



}

