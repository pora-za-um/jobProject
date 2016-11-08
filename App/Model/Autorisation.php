<?php

namespace App\Model;

use App\Model;

class Autorisation
    extends Model
{

    public function actionChekLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (empty($_POST['login']) || empty($_POST['password'])) {
                throw new \Exception("Пустой логин или пароль <br><a href='/../../'>Главная страница</a>");
            }


            $name = $_POST['login'];
            $password = $_POST['password'];


            $name = $this->clean($name);
            $password = $this->clean($password);


            if (User::findByLoginAndPass($name, $password) == false) {


                throw new \Exception("Извините, введённый вами логин или пароль неверный <br><a href='/../../'>Главная страница</a>");

            } else {
                $_SESSION['login'] = $name;
                $_SESSION['password'] = $password;

                $obj = User::findUserIdByLogin($name);
                $dummy = get_object_vars($obj);

                $_SESSION['id'] = $dummy['user_id'];

                echo "Вы успешно вошли на сайт! <a href='/../../'>Главная страница</a>";
            }

        }
    }


    //обработка логина и пароля, чтобы теги и скрипты не работали
    public function clean($value = "")
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    public function actionSaveUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['login'];
            $password = $_POST['password'];
            $email = $_POST['email'];


            $name = $this->clean($name);
            $password = $this->clean($password);
            $email = $this->clean($email);


            if (!empty($name) && !empty($password) && !empty($email)) {
                $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
                if ($this->check_length($name, 2, 25) && $this->check_length($password, 4, 15) && $email_validate) {


                    if (User::findByLoginOrEmail($name, $email) != false) {
                        exit ("Извините, введённый вами логин или email уже зарегистрированы. Введите другой логин или email.");
                    }

                    $data = ['login' => $name, 'password' => $password, 'email' => $email];

                    User::insertUser($data);

                    echo "Ваше имя: ", $name, "<br> Ваш e-mail: ", $email, "<br> Теперь вы можете зайти на сайт. <a href='/../../'>Главная страница</a>";


                } else {
                    echo "Введенные данные некорректные";
                }
            } else {
                echo "Заполните пустые поля";
            }
        } else {
            echo 'что-то не получилось';
            //header("Location: /../index.php");
        }


    }

    public function check_length($value = "", $min, $max)
    {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }


}