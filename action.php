<?php
require_once 'utils.php';
require_once 'database.php';

class AuthSystem
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function registerUser($name, $email, $password, $confirm_password)
    {
        $name = Utils::sanitize($name);
        $email = Utils::sanitize($email);
        $password = Utils::sanitize($password);
        $confirm_password = Utils::sanitize($confirm_password);

        if ($password !== $confirm_password) {
            Utils::setFlash('register_error', 'Senhas não conferem.');
        } else {
            $user = $this->db->getUserByEmail($email);

            if ($user) {
                Utils::setFlash('register_error', 'Usuário já existe.');
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $this->db->register($name, $email, $hashed_password);
                Utils::setFlash('register_success', 'Cadastrado com sucesso!');
                Utils::redirect('index.php');
            }
        }
    }

    public function loginUser($email, $password)
    {
        $email = Utils::sanitize($email);
        $password = Utils::sanitize(($password));

        $user = $this->db->login($email, $password);
        if ($user) {
            Utils::redirect('profile.php');
        } else {
            Utils::setFlash('login_error', 'Invalid credentials');
        }
    }

    public function forgotPassword($email)
    {
        $user = $this->db->getUserByEmail($email);
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hora de validade

            $this->db->saveToken($token, $expires_at, $email);

            $resetLink = $this->db->sendForgotEmail($email, $token);

            Utils::setFlash('login_success', 'E-mail enviado com o link de recuperação.');
            // Utils::redirect('index.php');
            echo "Link de recuperação: <a href='$resetLink'>$resetLink</a>";
            exit();
        } else {
            Utils::setFlash('login_error', 'E-mail não encontrado.');
            Utils::redirect('forgot.php');
        }
    }
}

$authSystem = new AuthSystem();

if (isset($_POST['register'])) {
    $authSystem->registerUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
} elseif (isset($_POST['login'])) {
    $authSystem->loginUser($_POST['email'], $_POST['password']);
}

if (isset($_GET['logout'])) {
    session_destroy();
    Utils::redirect('index.php');
}

if (isset($_POST['forgot'])) {
    $authSystem->forgotPassword($_POST['email']);
}
