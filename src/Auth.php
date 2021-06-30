<?php

namespace App;

class Auth
{

    public static function isAuth()
    {
        if ($_SESSION['logged']) {
            return true;
        } else {
            return false;
        }
    }

    public static function isAdmin()
    {
        if ($_SESSION['uinfo']) {
            return $_SESSION['uinfo']['role'] == 'admin';
        } else {
            return false;
        }
    }

    public static function getName()
    {
        if ($_SESSION['uinfo']) {
            return $_SESSION['uinfo']['username'];
        } else {
            return null;
        }
    }
}
