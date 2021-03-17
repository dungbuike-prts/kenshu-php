<?php


class Csrf extends Helper
{
    public static function generateToken() {
        $toke_byte = openssl_random_pseudo_bytes(16);
        $csrf_token = bin2hex($toke_byte);
        $_SESSION['csrf_token'] = $csrf_token;
        return $csrf_token;
    }

    public static function verify() {
        if (isset($_POST["csrf_token"])
            && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
            unset($_SESSION['csrf_token']);
            return true;
        } else {
            return header('Location:/');
        }

    }

}