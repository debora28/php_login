<?php
session_start();
require_once('utils.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark bg-gradient">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="fw-bold text-secondary">Cadastro</h1>
                    </div>
                    <div class="card-body p-5">
                        <?php
                        Utils::displayFlash('register_success', 'success');
                        Utils::displayFlash('register_error', 'danger');
                        ?>
                        <form action="action.php" method="POST">
                            <input type="hidden" name="register" value="1" />
                            <div class="mb-3">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="name">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password">Confirme a Senha</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Cadastrar" class="btn btn-primary">
                            </div>
                            <p class="text-center">Já tem uma conta? <a href="index.php" class="">Login</a> </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>