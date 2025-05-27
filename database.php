<?php
require_once 'config.php';

class Database
{
    //MSSql
    // private const DSN = 'sqlsrv:Server=' . DB_HOST . ';Database=' . DB_NAME;
    private $conn;

    public function __construct()
    {
        try {
            //MSSql
            // $this->conn = new PDO(self::DSN);
            //MySQL
            $this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function register($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES(:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user;
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'createdAt' => $user['createdAt'],
                    'updatedAt' => $user['updatedAt']
                ];
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sendForgotEmail($email, $token)
    {
        $resetLink = BASE_URL . "/reset.php?token=$token";

        $subject = "Link para redefinir sua senha";
        $message = "Olá!\n\nClique no link abaixo para redefinir sua senha:\n\n$resetLink\n\nEste link expira em 1 hora.";
        $headers = "From: no-reply@seudominio.com";

        mail($email, $subject, $message, $headers);
        return $resetLink;
    }

    public function saveToken($token, $expires_at, $email){
        $stmt = $this->conn->prepare("UPDATE users SET token = ? WHERE email = ?");
        $stmt->execute([$token, $email]);
    }
}
