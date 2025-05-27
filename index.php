<?php
session_start();
require_once('utils.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark bg-gradient">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="fw-bold text-secondary">Login</h1>
                    </div>
                    <div class="card-body p-5">
                        <?php
                        Utils::displayFlash('register_success', 'success');
                        Utils::displayFlash('register_error', 'danger');
                        ?>
                        <form action="<?= BASE_URL ?>/action.php" method="POST">
                            <input type="hidden" name="login" value="1" />
                            <div class="mb-3">
                                <label for="name">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Senha</label>
                                <input type="text" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <a href="forgot.php">Esqueceu a Senha</a>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Login" class="btn btn-primary">
                            </div>
                            <p class="text-center">Ainda não tem uma conta? <a href="register.php" class="">Cadastre-se</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>