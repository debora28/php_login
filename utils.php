<?php
require_once 'config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Utils
{
    public static function sanitize($input)
    {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        return $input;
    }
    public static function redirect($page)
    {
        header('location: ' . BASE_URL . '/' . ltrim($page, '/'));
        exit();
    }
    public static function setFlash($name, $message)
    {
        if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
        $_SESSION[$name] = $message;
    }
    public static function displayFlash($name, $type)
    {
        if (isset($_SESSION[$name])) {
            echo '<div class="alert alert-' . $type . '">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
        }
    }
    public static function isLoggedIn($messages)
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
}
