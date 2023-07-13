<?php

// session start for user authentication
session_start();

class User
{
    public $db;

    public function __construct()
    {
        $this->db = new Db();
    }


    public function register($name, $mail, $password, $login = false)
    {
        $name = senitize_string($name);
        $mail = senitize_string($mail);
        $password = senitize_string($password);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $timestamp = time();

        $sql = "INSERT INTO `admin_users` (`name`, `email`, `password`, `role`, `status`, `update_on`, `added_on`) VALUES ('$name', '$mail', '$password', '1', '1', '$timestamp', '$timestamp')";



        $this->db->query($sql);
        if (mysqli_insert_id($this->db->con)) {
            $user['id'] = mysqli_insert_id($this->db->con);
            $user['name'] = $name;
            $user['email'] = $mail;
            if ($login) {
                $this->save_user_session($user);
            }
            return true;
        }

        return false;
    }

    public function login($email, $pass)
    {
        // $pass = md5($pass);
        $user = $this->db->fetch_data("SELECT * FROM `admin_users` WHERE `email` = '$email'");

        if ($user) {
            if (isset($user['password']) && $user['password'] != '') {
                if (password_verify($pass, $user['password'])) {
                    $this->save_user_session($user);
                    return true;
                }
            }
        }
        return false;
    }

    public static function isAuthorized()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_name'] && $_SESSION['user_email'] && isset($_SESSION['time'])) {
            $time = $_SESSION['time'];
            if ($time + 1200000 > time()) {
                $_SESSION['time'] = time();
                return true;
            } else {
                self::logout();
            }
        }
        return false;
    }

    public static function logout()
    {
        session_destroy();
        header('Location:' . home_path() . '/login');
    }

    public static function id()
    {
        return self::isAuthorized() ? $_SESSION['user_id'] : false;
    }

    public static function name()
    {
        return self::isAuthorized() ? $_SESSION['user_name'] : false;
    }

    public static function email()
    {
        return self::isAuthorized() ? $_SESSION['user_email'] : false;
    }

    private function save_user_session($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['time'] = time();
    }
}
