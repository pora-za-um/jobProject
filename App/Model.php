<?php

namespace App;

abstract class Model
{

    public static $table;
    public static $data = [];
    public $id;

    public static function findAll()
    {
        $db = new DB();
        $data = $db->query(
            'SELECT * FROM ' . static::$table,
            [],
            static::class
        );
        return $data;
    }

    public static function photoInsert($data)
    {

        $sql = "
          INSERT INTO images
          (title, textimg, path, date, user_id)
          VALUES
          ('" . $data['title'] . "', '" . $data['textimg'] . "', '" . $data['path'] . "', '" . $data['date'] . "', '" . $data['user_id'] . "')
          ";
        $db = new DB();
        //Sql_execute($sql);
        return $db->execute($sql, $data);

    }

    public static function photoEdit($data)
    {
        $db = new DB();
        $db->query("UPDATE images
                SET title='" . $data['title'] . "', textimg='" . $data['textimg'] . "'
                WHERE id =" . $data['id']);

    }

    public static function profileInformationEdit($data)
    {
        $db = new DB();

        $i = 0;

        foreach ($data as $value) {
            $data[$value] = "'$value'";

            $keys = array_keys($data);

            $db->query("UPDATE users
                SET " . $keys[$i] . '=' . $data[$value] . "
                WHERE user_id =" . $data['user_id']);

            $i++;

        }
    }


    public static function increaseImgCount($id)
    {
        $db = new DB();
        $db->query('UPDATE users
                SET img_count=img_count+1
                WHERE user_id =' . $id);

    }

    public static function decreaseImgCount($id)
    {
        $db = new DB();
        $db->query('UPDATE users
                SET img_count=img_count-1
                WHERE user_id =' . $id);

    }

    public static function findByLoginAndPass($login, $pass)
    {
        $db = new DB();
        $sql = 'SELECT login, password FROM ' . static::$table . ' WHERE login =:login AND password =:password';
        $data = $db->query($sql, [':login' => $login, ':password' => $pass], static::class);
        return $data[0] ?? false;
    }

    public static function findByLoginOrEmail($login, $email)
    {
        $db = new DB();
        $sql = 'SELECT login, email FROM ' . static::$table . ' WHERE login =:login OR email =:email';
        $data = $db->query($sql, [':login' => $login, ':email' => $email], static::class);
        return $data[0] ?? false;
    }

    public static function findUserIdByLogin($login)
    {
        $db = new DB();
        $sql = 'SELECT user_id FROM ' . static::$table . ' WHERE login =:login';
        $data = $db->query($sql, [':login' => $login], static::class);
        return $data[0];

    }

    public static function findByUserId($id)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE user_id =' . $id;
        $data = $db->query($sql, [':user_id' => $id], static::class);

        return $data ?? false;
    }

    public static function findPhotoByUserId($id)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id =' . $id;
        $data = $db->query($sql, [':user_id' => $id], static::class);

        return $data ?? false;
    }

    public static function findLast5()
    {
        $db = new DB();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT 5', [], static::class
        );

        return $data;

    }

    public static function findUsers()
    {
        $db = new DB();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE img_count>0 ORDER BY user_id DESC', [], static::class
        );

        return $data;
    }

    public static function findByColumn($column, $value)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value';
        $res = $db->query($sql, [':value' => $value], static::class);

        return $res ?? false;
    }

    public static function delete($id)
    {
        $db = new DB();
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        return $db->query($sql, [':id' => $id]);
    }

    public function insertUser($data)
    {
        if (!is_array($data)) {
            throw new \Exception('Нужно передавать массив');
        }

        //удаление из массива что не надо обрабатывать
        if (isset($data['id'])) {
            unset($data['id']);
        }

        //получение колонок, которые будут добавлены
        $colums = implode(',', array_keys($data));
        //создание массива для метода execute
        $data = array_combine(
            array_map(function ($v) {
                return ':' . $v;
            }, array_keys($data)),
            $data
        );
        $params = implode(',', array_keys($data));
        $tableName = static::$table;

        $sql = "INSERT INTO {$tableName} ({$colums}) VALUES ({$params})";
        $db = new DB();
        return $db->execute($sql, $data);
    }

}