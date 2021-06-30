<?php

namespace App\Models;

use App\Model;

class UserModel extends Model
{
    private $table = 'users';

    public function checkUser($username)
    {
        $data = $this->get($this->table)->fetchAll(\PDO::FETCH_CLASS);
        if ($data[$username]) {
            return $username;
        } else {
            return null;
        }
    }

    public function validate($username, $password)
    {
        $data = $this->getUser($this->table, $username)->fetchAll(\PDO::FETCH_CLASS);
        $data = $data[0];
        if ($data != null) {
            if ($data->password == $password) {
                return true;
            }
        }
        return false;
    }

    public function getInfoUser($username)
    {
        $data = $this->getUser($this->table, $username)->fetchAll(\PDO::FETCH_CLASS);
        $data = $data[0];
        return $data;
    }
}
